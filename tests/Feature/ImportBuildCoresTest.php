<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Http;

test('import buildcores command imports products with specs and images', function () {
    $category = Category::create([
        'name' => 'Processors (CPU)',
        'slug' => 'processors-cpu',
        'type' => 'hardware',
    ]);

    Http::fake([
        'https://api.github.com/repos/buildcores/buildcores-open-db/contents/open-db/CPU' => Http::response([
            [
                'name' => '4dcfffec-423b-4052-8aca-db6c0f84bb43.json',
                'download_url' => 'https://raw.githubusercontent.com/buildcores/buildcores-open-db/main/open-db/CPU/4dcfffec.json',
            ],
        ], 200),
        'https://raw.githubusercontent.com/buildcores/buildcores-open-db/main/open-db/CPU/4dcfffec.json' => Http::response([
            'metadata' => [
                'name' => 'AMD Ryzen 7 7800X3D',
                'manufacturer' => 'AMD',
            ],
            'socket' => 'AM5',
            'cores' => ['total' => 8, 'threads' => 16],
            'clocks' => ['performance' => ['base' => 4.2, 'boost' => 5.0]],
            'cache' => ['l3' => 96],
            'specifications' => ['tdp' => 120],
            'identifiers' => [
                'retailer_listings' => [
                    ['source' => 'amazon', 'source_product_id' => 'B0BTZB7F88'],
                ],
            ],
        ], 200),
        'https://images-na.ssl-images-amazon.com/images/P/B0BTZB7F88.01._SCLZZZZZZZ_SX800_.jpg' => Http::response('', 200),
    ]);

    $this->artisan('shop:import-buildcores', ['--category' => 'CPU', '--limit' => 1])
        ->assertSuccessful();

    $this->assertDatabaseHas('products', [
        'name' => 'AMD Ryzen 7 7800X3D',
        'slug' => 'amd-ryzen-7-7800x3d',
        'brand' => 'AMD',
        'type' => 'hardware',
        'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B0BTZB7F88.01._SCLZZZZZZZ_SX800_.jpg',
    ]);

    $product = Product::where('slug', 'amd-ryzen-7-7800x3d')->first();
    expect($product->specs)->toBeArray()
        ->and($product->specs['Socket'])->toBe('AM5')
        ->and($product->specs['Cores / Threads'])->toBe('8 Cores / 16 Threads');
});

test('import buildcores handles non-existent category gracefully', function () {
    $this->artisan('shop:import-buildcores', ['--category' => 'UnknownCategory'])
        ->assertSuccessful();
});
