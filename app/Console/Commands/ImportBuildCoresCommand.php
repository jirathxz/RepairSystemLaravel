<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ImportBuildCoresCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:import-buildcores 
                            {--category= : Specific category to import (CPU, GPU, RAM, Motherboard, Storage, PCCase, PSU)}
                            {--limit=3 : Number of items per category}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import PC hardware components and images from buildcores/buildcores-open-db GitHub repository';

    /**
     * Category mapping between BuildCores open-db and local category slugs.
     *
     * @var array<string, string>
     */
    protected array $categoryMap = [
        'CPU' => 'processors-cpu',
        'GPU' => 'graphics-cards-gpu',
        'RAM' => 'memory-ram',
        'Motherboard' => 'motherboards',
        'Storage' => 'storage-ssd',
        'PCCase' => 'pc-cases',
        'PSU' => 'power-supply-psu',
    ];

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $targetCategory = $this->option('category');
        $limit = (int) $this->option('limit');

        $categoriesToProcess = $targetCategory
            ? [$targetCategory => $this->categoryMap[$targetCategory] ?? null]
            : $this->categoryMap;

        $this->info('Starting BuildCores OpenDB import...');

        $totalImported = 0;

        foreach ($categoriesToProcess as $buildCoresCat => $localSlug) {
            if (! $localSlug) {
                $this->warn("Category {$buildCoresCat} is not mapped. Skipping.");

                continue;
            }

            $category = Category::where('slug', $localSlug)->first();
            if (! $category) {
                $this->warn("Local category '{$localSlug}' not found in database. Please run seeders first.");

                continue;
            }

            $this->line("<fg=cyan>Fetching components for category: {$buildCoresCat}...</>");

            $imported = $this->importCategory($buildCoresCat, $category, $limit);
            $totalImported += $imported;
        }

        $this->info("BuildCores import finished! Total products imported/updated: {$totalImported}");

        return self::SUCCESS;
    }

    /**
     * Import components for a specific BuildCores category.
     */
    protected function importCategory(string $buildCoresCat, Category $category, int $limit): int
    {
        $apiUrl = "https://api.github.com/repos/buildcores/buildcores-open-db/contents/open-db/{$buildCoresCat}";

        $response = Http::withHeaders([
            'User-Agent' => 'TechStore-Laravel-Importer',
        ])->timeout(15)->get($apiUrl);

        if (! $response->successful()) {
            $this->error("Failed to fetch {$buildCoresCat} listing from GitHub API. HTTP {$response->status()}");

            return 0;
        }

        $files = $response->json();
        if (! is_array($files)) {
            return 0;
        }

        $imported = 0;

        foreach ($files as $file) {
            if ($imported >= $limit) {
                break;
            }

            if (! isset($file['download_url'])) {
                continue;
            }

            $itemResponse = Http::timeout(10)->get($file['download_url']);
            if (! $itemResponse->successful()) {
                continue;
            }

            $data = $itemResponse->json();
            if (! is_array($data) || empty($data['metadata']['name'])) {
                continue;
            }

            $asin = $this->extractAmazonAsin($data);
            if (! $asin) {
                continue;
            }

            $imageUrl = "https://images-na.ssl-images-amazon.com/images/P/{$asin}.01._SCLZZZZZZZ_SX800_.jpg";

            // Verify image exists
            $imgCheck = Http::timeout(5)->head($imageUrl);
            if (! $imgCheck->successful()) {
                continue;
            }

            $name = trim($data['metadata']['name']);
            $brand = trim($data['metadata']['manufacturer'] ?? 'BuildCores');
            $slug = Str::slug($name);

            // Clean specs array for display
            $specs = $this->formatSpecs($buildCoresCat, $data);
            $price = $this->estimatePrice($buildCoresCat, $name, $specs);

            Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $category->id,
                    'name' => $name,
                    'brand' => $brand,
                    'type' => 'hardware',
                    'price' => $price,
                    'stock' => rand(8, 25),
                    'description' => $this->generateDescription($buildCoresCat, $name, $specs),
                    'specs' => $specs,
                    'image_url' => $imageUrl,
                    'is_featured' => $imported === 0,
                ]
            );

            $this->line("  <fg=green>✓</> {$name} <fg=gray>(ASIN: {$asin})</>");
            $imported++;
        }

        return $imported;
    }

    /**
     * Extract Amazon ASIN from component data.
     *
     * @param  array<string, mixed>  $data
     */
    protected function extractAmazonAsin(array $data): ?string
    {
        if (! empty($data['general_product_information']['amazon_sku'])) {
            return (string) $data['general_product_information']['amazon_sku'];
        }

        if (! empty($data['identifiers']['retailer_listings']) && is_array($data['identifiers']['retailer_listings'])) {
            foreach ($data['identifiers']['retailer_listings'] as $listing) {
                if (($listing['source'] ?? '') === 'amazon' && ! empty($listing['source_product_id'])) {
                    return (string) $listing['source_product_id'];
                }
            }
        }

        return null;
    }

    /**
     * Format clean specifications from BuildCores component JSON.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, string>
     */
    protected function formatSpecs(string $category, array $data): array
    {
        $specs = [];

        switch ($category) {
            case 'CPU':
                if (! empty($data['socket'])) {
                    $specs['Socket'] = (string) $data['socket'];
                }
                if (! empty($data['cores']['total'])) {
                    $threads = $data['cores']['threads'] ?? ($data['cores']['total'] * 2);
                    $specs['Cores / Threads'] = "{$data['cores']['total']} Cores / {$threads} Threads";
                }
                if (! empty($data['clocks']['performance']['base']) && ! empty($data['clocks']['performance']['boost'])) {
                    $specs['Clocks'] = "{$data['clocks']['performance']['base']} GHz Base / {$data['clocks']['performance']['boost']} GHz Boost";
                }
                if (! empty($data['cache']['l3'])) {
                    $specs['L3 Cache'] = "{$data['cache']['l3']} MB";
                }
                if (! empty($data['specifications']['tdp'])) {
                    $specs['TDP'] = "{$data['specifications']['tdp']} W";
                }
                break;

            case 'GPU':
                if (! empty($data['chipset'])) {
                    $specs['Chipset'] = (string) $data['chipset'];
                }
                if (! empty($data['memory'])) {
                    $specs['VRAM'] = "{$data['memory']} GB ".($data['memory_type'] ?? 'GDDR6');
                }
                if (! empty($data['memory_bus'])) {
                    $specs['Memory Bus'] = "{$data['memory_bus']}-bit";
                }
                if (! empty($data['core_boost_clock'])) {
                    $specs['Boost Clock'] = "{$data['core_boost_clock']} MHz";
                }
                if (! empty($data['tdp'])) {
                    $specs['TDP'] = "{$data['tdp']} W";
                }
                if (! empty($data['interface'])) {
                    $specs['Interface'] = (string) $data['interface'];
                }
                break;

            case 'RAM':
                if (! empty($data['speed'])) {
                    $specs['Speed'] = "DDR5-{$data['speed']} MHz";
                }
                if (! empty($data['capacity'])) {
                    $specs['Capacity'] = "{$data['capacity']} GB";
                }
                if (! empty($data['cas_latency'])) {
                    $specs['Latency'] = "CL{$data['cas_latency']}";
                }
                if (! empty($data['voltage'])) {
                    $specs['Voltage'] = "{$data['voltage']} V";
                }
                break;

            case 'Motherboard':
                if (! empty($data['socket'])) {
                    $specs['Socket'] = (string) $data['socket'];
                }
                if (! empty($data['chipset'])) {
                    $specs['Chipset'] = (string) $data['chipset'];
                }
                if (! empty($data['form_factor'])) {
                    $specs['Form Factor'] = (string) $data['form_factor'];
                }
                if (! empty($data['wireless_networking'])) {
                    $specs['Wireless'] = (string) $data['wireless_networking'];
                }
                break;

            case 'Storage':
                if (! empty($data['capacity'])) {
                    $specs['Capacity'] = "{$data['capacity']} GB";
                }
                if (! empty($data['storage_type'])) {
                    $specs['Type'] = (string) $data['storage_type'];
                }
                if (! empty($data['interface'])) {
                    $specs['Interface'] = (string) $data['interface'];
                }
                if (! empty($data['form_factor'])) {
                    $specs['Form Factor'] = (string) $data['form_factor'];
                }
                break;

            case 'PCCase':
                if (! empty($data['form_factor'])) {
                    $specs['Form Factor'] = (string) $data['form_factor'];
                }
                if (! empty($data['color'])) {
                    $specs['Color'] = is_array($data['color']) ? implode(', ', $data['color']) : (string) $data['color'];
                }
                if (! empty($data['side_panel'])) {
                    $specs['Side Panel'] = (string) $data['side_panel'];
                }
                if (! empty($data['max_video_card_length'])) {
                    $specs['Max GPU Length'] = "{$data['max_video_card_length']} mm";
                }
                break;

            case 'PSU':
                if (! empty($data['wattage'])) {
                    $specs['Wattage'] = "{$data['wattage']} W";
                }
                if (! empty($data['efficiency_rating'])) {
                    $specs['Efficiency'] = "80+ {$data['efficiency_rating']}";
                }
                if (! empty($data['modular'])) {
                    $specs['Modular'] = (string) $data['modular'];
                }
                if (! empty($data['form_factor'])) {
                    $specs['Form Factor'] = (string) $data['form_factor'];
                }
                break;
        }

        $specs['Database Source'] = 'BuildCores OpenDB';

        return $specs;
    }

    /**
     * Generate Thai description for component.
     *
     * @param  array<string, string>  $specs
     */
    protected function generateDescription(string $category, string $name, array $specs): string
    {
        $specSummary = collect($specs)
            ->filter(fn ($v, $k) => $k !== 'Database Source')
            ->map(fn ($v, $k) => "{$k}: {$v}")
            ->take(3)
            ->implode(', ');

        return "สินค้าคุณภาพมาตรฐานระดับโลก ข้อมูลสเปกจากฐานข้อมูลเปิด BuildCores OpenDB ({$specSummary}) รองรับการใช้งานเต็มประสิทธิภาพ รับประกันศูนย์ไทยแท้";
    }

    /**
     * Estimate realistic Thai Baht price for component.
     *
     * @param  array<string, string>  $specs
     */
    protected function estimatePrice(string $category, string $name, array $specs): float
    {
        $lower = strtolower($name);

        if ($category === 'GPU') {
            if (str_contains($lower, '4090')) {
                return 69900.00;
            }
            if (str_contains($lower, '4080')) {
                return 39900.00;
            }
            if (str_contains($lower, '4070 ti')) {
                return 28500.00;
            }
            if (str_contains($lower, '4070')) {
                return 21900.00;
            }
            if (str_contains($lower, '4060')) {
                return 11900.00;
            }
            if (str_contains($lower, '7900 xtx')) {
                return 36900.00;
            }
            if (str_contains($lower, '570')) {
                return 4900.00;
            }

            return 18900.00;
        }

        if ($category === 'CPU') {
            if (str_contains($lower, 'threadripper')) {
                return 145000.00;
            }
            if (str_contains($lower, '7800x3d')) {
                return 16900.00;
            }
            if (str_contains($lower, '7950x')) {
                return 22900.00;
            }
            if (str_contains($lower, '14700k')) {
                return 15900.00;
            }
            if (str_contains($lower, '14900k')) {
                return 23900.00;
            }
            if (str_contains($lower, '7600')) {
                return 7900.00;
            }
            if (str_contains($lower, 'xeon')) {
                return 18900.00;
            }

            return 10900.00;
        }

        if ($category === 'RAM') {
            if (str_contains($lower, '128gb')) {
                return 14900.00;
            }
            if (str_contains($lower, '64gb')) {
                return 8490.00;
            }
            if (str_contains($lower, '48gb')) {
                return 6890.00;
            }
            if (str_contains($lower, '32gb')) {
                return 4290.00;
            }

            return 3290.00;
        }

        if ($category === 'Storage') {
            if (str_contains($lower, '2tb') || str_contains($lower, '2000gb')) {
                return 6890.00;
            }
            if (str_contains($lower, '1tb') || str_contains($lower, '1000gb')) {
                return 3690.00;
            }
            if (str_contains($lower, '512gb')) {
                return 1490.00;
            }

            return 2890.00;
        }

        if ($category === 'Motherboard') {
            if (str_contains($lower, 'z790') || str_contains($lower, 'x670')) {
                return 12900.00;
            }
            if (str_contains($lower, 'b650') || str_contains($lower, 'b860')) {
                return 8900.00;
            }
            if (str_contains($lower, 'b760')) {
                return 4590.00;
            }

            return 5490.00;
        }

        if ($category === 'PCCase') {
            if (str_contains($lower, 'lian li') || str_contains($lower, 'starfield')) {
                return 4990.00;
            }

            return 2990.00;
        }

        if ($category === 'PSU') {
            if (str_contains($lower, '1600w')) {
                return 19900.00;
            }
            if (str_contains($lower, '1000w')) {
                return 6900.00;
            }
            if (str_contains($lower, '850w') || str_contains($lower, '850')) {
                return 4690.00;
            }

            return 3290.00;
        }

        return 4900.00;
    }
}
