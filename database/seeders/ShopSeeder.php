<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Categories
        $categories = [
            // Hardware
            [
                'name' => 'Processors (CPU)',
                'slug' => 'processors-cpu',
                'type' => 'hardware',
                'description' => 'โปรเซสเซอร์ประสิทธิภาพสูงสำหรับการเล่นเกมและทำงานหนัก',
                'icon' => 'Cpu',
            ],
            [
                'name' => 'Graphics Cards (GPU)',
                'slug' => 'graphics-cards-gpu',
                'type' => 'hardware',
                'description' => 'การ์ดจอแยกสำหรับกราฟิก ตัดต่อ และเกมมิ่งความละเอียดสูง',
                'icon' => 'Monitor',
            ],
            [
                'name' => 'Memory (RAM)',
                'slug' => 'memory-ram',
                'type' => 'hardware',
                'description' => 'หน่วยความจำ DDR4 / DDR5 ความเร็วสูง',
                'icon' => 'HardDrive',
            ],
            [
                'name' => 'Storage (SSD / M.2)',
                'slug' => 'storage-ssd',
                'type' => 'hardware',
                'description' => 'ไดรฟ์ SSD NVMe PCIe 4.0/5.0 อ่านเขียนความเร็วสูง',
                'icon' => 'Database',
            ],
            [
                'name' => 'Motherboards (Mainboard)',
                'slug' => 'motherboards',
                'type' => 'hardware',
                'description' => 'เมนบอร์ดรองรับ Intel และ AMD ชิปเซ็ตล่าสุด',
                'icon' => 'CircuitBoard',
            ],
            [
                'name' => 'Power Supply (PSU)',
                'slug' => 'power-supply-psu',
                'type' => 'hardware',
                'description' => 'พาวเวอร์ซัพพลายมาตรฐาน 80 Plus ประหยัดพลังงาน เสถียร',
                'icon' => 'Zap',
            ],
            [
                'name' => 'PC Cases',
                'slug' => 'pc-cases',
                'type' => 'hardware',
                'description' => 'เคสคอมพิวเตอร์ดีไซน์สวยงาม ระบายความร้อนยอดเยี่ยม',
                'icon' => 'Box',
            ],
            // Software
            [
                'name' => 'Operating Systems',
                'slug' => 'operating-systems',
                'type' => 'software',
                'description' => 'ระบบปฏิบัติการลิขสิทธิ์แท้ Windows 11 OEM/FPP',
                'icon' => 'Laptop',
            ],
            [
                'name' => 'Office & Productivity',
                'slug' => 'office-productivity',
                'type' => 'software',
                'description' => 'โปรแกรมออฟฟิศ ลิขสิทธิ์แท้สำหรับการทำงานและธุรกิจ',
                'icon' => 'FileSpreadsheet',
            ],
            [
                'name' => 'Security & Antivirus',
                'slug' => 'security-antivirus',
                'type' => 'software',
                'description' => 'โปรแกรมป้องกันไวรัส ความปลอดภัยและปกป้องข้อมูลส่วนตัว',
                'icon' => 'ShieldCheck',
            ],
            [
                'name' => 'Developer Tools',
                'slug' => 'developer-tools',
                'type' => 'software',
                'description' => 'เครื่องมือและ IDE สำหรับนักพัฒนาซอฟต์แวร์ระดับมืออาชีพ',
                'icon' => 'Code2',
            ],
        ];

        $createdCategories = [];
        foreach ($categories as $cat) {
            $createdCategories[$cat['slug']] = Category::updateOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }

        // 2. Products
        $products = [
            // CPU (BuildCores OpenDB)
            [
                'category_slug' => 'processors-cpu',
                'name' => 'AMD Ryzen 7 7800X3D',
                'slug' => 'amd-ryzen-7-7800x3d',
                'brand' => 'AMD',
                'type' => 'hardware',
                'price' => 16500.00,
                'stock' => 15,
                'description' => 'โปรเซสเซอร์สถาปัตยกรรม Zen 4 พร้อมเทคโนโลยี 3D V-Cache 8 คอร์ 16 เธรด แคช L3 รวม 96MB เพื่อการเล่นเกมระดับสูงสุด',
                'specs' => [
                    'Socket' => 'AM5',
                    'Architecture' => 'Zen 4 (TSMC 5nm)',
                    'Cores / Threads' => '8 Cores / 16 Threads',
                    'Base / Boost Clock' => '4.2 GHz / 5.0 GHz',
                    'L3 Cache' => '96MB 3D V-Cache',
                    'TDP' => '120W',
                    'Integrated Graphics' => 'AMD Radeon Graphics',
                    'BuildCores ID' => '4dcfffec-423b-4052-8aca-db6c0f84bb43',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B0BTZB7F88.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'processors-cpu',
                'name' => 'Intel Core i7-14700K',
                'slug' => 'intel-core-i7-14700k',
                'brand' => 'Intel',
                'type' => 'hardware',
                'price' => 15900.00,
                'stock' => 12,
                'description' => 'โปรเซสเซอร์ Raptor Lake Refresh 20 คอร์ 28 เธรด พร้อมความเร็ว Boost สูงสุด 5.6 GHz รองรับงานคำนวณและตัดต่อวิดีโอ',
                'specs' => [
                    'Socket' => 'LGA 1700',
                    'Architecture' => 'Raptor Lake Refresh (Intel 7)',
                    'Cores / Threads' => '20 Cores (8P + 12E) / 28 Threads',
                    'Performance Clock' => 'Base 3.4 GHz / Boost 5.5 GHz',
                    'Efficiency Clock' => 'Base 2.5 GHz / Boost 4.3 GHz',
                    'Smart Cache' => '33MB Intel Smart Cache (L2 28MB)',
                    'TDP' => '125W (Max Turbo 253W)',
                    'Integrated Graphics' => 'Intel UHD Graphics 770',
                    'BuildCores ID' => '622e7110-ebf4-4040-93f6-5b37e82ff02e',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B0CGJ41C9W.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'processors-cpu',
                'name' => 'AMD Ryzen Threadripper 9980X',
                'slug' => 'amd-ryzen-threadripper-9980x',
                'brand' => 'AMD',
                'type' => 'hardware',
                'price' => 129000.00,
                'stock' => 3,
                'description' => 'โปรเซสเซอร์เวิร์กสเตชันระดับสูงสุด 64 คอร์ 128 เธรด สถาปัตยกรรม Zen 5 สำหรับงานเรนเดอร์ 3D และประมวลผลขนาดใหญ่',
                'specs' => [
                    'Socket' => 'sTR5',
                    'Architecture' => 'Zen 5',
                    'Cores / Threads' => '64 Cores / 128 Threads',
                    'Base / Boost Clock' => '3.2 GHz / 5.1 GHz',
                    'L3 Cache' => '256MB',
                    'TDP' => '350W',
                    'Memory Support' => '4-Channel DDR5 ECC RDIMM',
                    'BuildCores ID' => 'c1b48b11-2df8-4395-9ff0-547a06a06654',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B0FJ6JZN8K.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => false,
            ],

            // GPU (BuildCores OpenDB)
            [
                'category_slug' => 'graphics-cards-gpu',
                'name' => 'PNY XLR8 Gaming VERTO EPIC-X RGB GeForce RTX 4070 Ti 12GB',
                'slug' => 'pny-xlr8-geforce-rtx-4070-ti-12gb',
                'brand' => 'PNY',
                'type' => 'hardware',
                'price' => 29900.00,
                'stock' => 8,
                'description' => 'กราฟิกการ์ดสถาปัตยกรรม Ada Lovelace พร้อมพัดลมระบายความร้อน 3 ตัว และไฟ RGB EPIC-X รองรับ DLSS 3',
                'specs' => [
                    'GPU Chip' => 'AD104 GeForce RTX 4070 Ti',
                    'Video Memory' => '12GB GDDR6X',
                    'Memory Bus' => '192-bit (504.2 GB/s)',
                    'Boost Clock' => '2610 MHz',
                    'Length' => '305 mm',
                    'Interface' => 'PCIe 4.0 x16',
                    'Outputs' => '1x HDMI 2.1, 3x DisplayPort 1.4a',
                    'Recommended PSU' => '700W',
                    'BuildCores ID' => '4c21e065-ad2c-4610-8bfe-30f1d07c08a4',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B0BRKR14S1.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'graphics-cards-gpu',
                'name' => 'Zotac GAMING Trinity GeForce RTX 4080 SUPER 16GB',
                'slug' => 'zotac-gaming-trinity-rtx-4080-super-16gb',
                'brand' => 'Zotac',
                'type' => 'hardware',
                'price' => 38900.00,
                'stock' => 6,
                'description' => 'การ์ดจอทรงพลังระดับ 4K Gaming พร้อมระบบระบายความร้อน IceStorm 2.0 และไฟ SPECTRA RGB',
                'specs' => [
                    'GPU Chip' => 'AD103-400 GeForce RTX 4080 SUPER',
                    'CUDA Cores' => '10240 Cores',
                    'Video Memory' => '16GB GDDR6X',
                    'Memory Bus' => '256-bit (736 GB/s)',
                    'Boost Clock' => '2550 MHz',
                    'Length' => '306.8 mm',
                    'Recommended PSU' => '750W',
                    'BuildCores ID' => 'eb837965-cfef-4019-9524-7da3e2c34279',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B0CSBDFS55.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'graphics-cards-gpu',
                'name' => 'MSI GeForce RTX 4070 VENTUS 2X WHITE 12G OC',
                'slug' => 'msi-geforce-rtx-4070-ventus-2x-white-12g-oc',
                'brand' => 'MSI',
                'type' => 'hardware',
                'price' => 22500.00,
                'stock' => 10,
                'description' => 'การ์ดจอบอดี้สีขาวดีไซน์มินิมอล พัดลมคู่ TORX Fan 4.0 เงียบและเย็น เหมาะสำหรับการเล่นเกมความละเอียด 1440p',
                'specs' => [
                    'GPU Chip' => 'GeForce RTX 4070',
                    'Video Memory' => '12GB GDDR6X',
                    'Memory Bus' => '192-bit',
                    'Boost Clock' => '2505 MHz',
                    'Form Factor' => 'Dual Fan 242mm (White Edition)',
                    'Recommended PSU' => '650W',
                    'BuildCores ID' => 'msi-rtx-4070-ventus-white',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B0CHBRJCDV.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => false,
            ],
            [
                'category_slug' => 'graphics-cards-gpu',
                'name' => 'MSI Radeon RX 570 ARMOR MK2 8G OC',
                'slug' => 'msi-radeon-rx-570-armor-mk2-8g-oc',
                'brand' => 'MSI',
                'type' => 'hardware',
                'price' => 4500.00,
                'stock' => 8,
                'description' => 'การ์ดจอระดับเริ่มต้นยอดนิยม สถาปัตยกรรม Polaris 20 พร้อมพัดลม TORX 2.0 รองรับการเล่นเกมทั่วไปแบบประหยัดงบ',
                'specs' => [
                    'GPU Chip' => 'Polaris 20 XL (Radeon RX 570)',
                    'Video Memory' => '8GB GDDR5',
                    'Memory Bus' => '256-bit (224 GB/s)',
                    'Boost Clock' => '1268 MHz',
                    'Recommended PSU' => '450W',
                    'BuildCores ID' => '42fca121-6fdf-41a4-9ec4-d1ae537b0bca',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B079NW5Y1C.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => false,
            ],

            // RAM (BuildCores OpenDB)
            [
                'category_slug' => 'memory-ram',
                'name' => 'TEAMGROUP T-Create Expert DDR5-6400 48GB (2x24GB)',
                'slug' => 'teamgroup-t-create-expert-ddr5-6400-48gb',
                'brand' => 'TeamGroup',
                'type' => 'hardware',
                'price' => 6590.00,
                'stock' => 14,
                'description' => 'แรม DDR5 ความจุพิเศษ 48GB บัสสูง 6400MHz CL32 แผ่นกระจายความร้อนอะลูมิเนียมสีดำตัดทอง ระบายความร้อนเสถียร',
                'specs' => [
                    'Type' => '288-Pin DDR5 UDIMM Desktop',
                    'Capacity' => '48GB (2 x 24GB)',
                    'Frequency' => 'DDR5-6400 MHz (PC5-51200)',
                    'Latency' => 'CL32-39-39-84',
                    'Voltage' => '1.35V',
                    'Profile' => 'Intel XMP 3.0 & AMD EXPO',
                    'BuildCores ID' => 'e7fa266d-1bf9-450f-a9cb-b2f56743126f',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B0CQP3ZGNM.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'memory-ram',
                'name' => 'G.Skill Trident Z5 RGB DDR5-5600 64GB (2x32GB)',
                'slug' => 'gskill-trident-z5-rgb-ddr5-5600-64gb',
                'brand' => 'G.Skill',
                'type' => 'hardware',
                'price' => 8490.00,
                'stock' => 12,
                'description' => 'แรมระดับเรือธงพร้อมแถบไฟ RGB ดีไซน์สปอร์ต ความจุ 64GB ทำงานหลายโปรแกรมได้อย่างลื่นไหล',
                'specs' => [
                    'Type' => '288-Pin DDR5 UDIMM',
                    'Capacity' => '64GB (2 x 32GB)',
                    'Frequency' => 'DDR5-5600 MHz',
                    'Latency' => 'CL36-36-36-89',
                    'Voltage' => '1.25V',
                    'Lighting' => 'Customizable RGB Stream',
                    'BuildCores ID' => 'gskill-trident-z5-rgb-5600-64gb',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B0B71X8T7L.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'memory-ram',
                'name' => 'Crucial DDR5-5600 UDIMM 128GB (4x32GB)',
                'slug' => 'crucial-ddr5-5600-128gb-kit',
                'brand' => 'Crucial',
                'type' => 'hardware',
                'price' => 15900.00,
                'stock' => 6,
                'description' => 'ชุดแรมระดับเวิร์กสเตชัน 128GB สำหรับนักตัดต่อวิดีโอ 8K และจำลองสภาพแวดล้อมเสมือนจริง ความเสถียรมาตรฐาน Micron',
                'specs' => [
                    'Type' => 'DDR5 Desktop UDIMM Non-ECC',
                    'Capacity' => '128GB (4 x 32GB)',
                    'Speed' => '5600 MT/s',
                    'Voltage' => '1.1V',
                    'Manufacturer' => 'Crucial / Micron Technology',
                    'BuildCores ID' => 'crucial-ddr5-5600-128gb',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B0DSR5P84D.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => false,
            ],

            // Motherboards (BuildCores OpenDB)
            [
                'category_slug' => 'motherboards',
                'name' => 'ASUS B760M-AYW WIFI D4 Micro-ATX',
                'slug' => 'asus-b760m-ayw-wifi-d4',
                'brand' => 'ASUS',
                'type' => 'hardware',
                'price' => 4590.00,
                'stock' => 16,
                'description' => 'เมนบอร์ดขนาด Micro-ATX ซ็อกเก็ต LGA1700 พร้อม Wi-Fi 6 ในตัว ภาคจ่ายไฟทนทานและสล็อต M.2 PCIe 4.0 ความเร็วสูง',
                'specs' => [
                    'Socket' => 'LGA 1700 (12th/13th/14th Gen Intel)',
                    'Chipset' => 'Intel B760',
                    'Form Factor' => 'Micro-ATX (24.4cm x 21.1cm)',
                    'Memory' => '2x DDR4 Slots up to 5333(OC)',
                    'Expansion' => '1x PCIe 4.0 x16, 2x PCIe 4.0 x1',
                    'M.2 Slots' => '2x M.2 PCIe 4.0 x4 Mode',
                    'Networking' => 'Wi-Fi 6, Bluetooth 5.3, Realtek 2.5Gb Ethernet',
                    'BuildCores ID' => '1742461f-a63e-4d4d-b6eb-5d46fcf14a1a',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B0BNQGQF43.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'motherboards',
                'name' => 'MSI MPG B650 EDGE WIFI',
                'slug' => 'msi-mpg-b650-edge-wifi',
                'brand' => 'MSI',
                'type' => 'hardware',
                'price' => 9490.00,
                'stock' => 10,
                'description' => 'เมนบอร์ดสีเงินสว่างระดับพรีเมียมสำหรับซ็อกเก็ต AM5 ภาคจ่ายไฟ 14+2+1 เฟส พร้อมฮีตซิงก์ M.2 Shield Frozr',
                'specs' => [
                    'Socket' => 'AMD Socket AM5',
                    'Chipset' => 'AMD B650',
                    'Form Factor' => 'ATX',
                    'Memory' => '4x DDR5 Slots up to 6600+(OC)',
                    'M.2 Slots' => '3x M.2 (PCIe 5.0/4.0)',
                    'Wireless' => 'Wi-Fi 6E + Bluetooth 5.3',
                    'Audio' => 'Realtek ALC4080 7.1 HD Audio',
                    'BuildCores ID' => 'msi-mpg-b650-edge-wifi',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B0BHCD117G.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => true,
            ],

            // Storage (BuildCores OpenDB)
            [
                'category_slug' => 'storage-ssd',
                'name' => 'Samsung 990 Pro 2TB PCIe 4.0 NVMe M.2 SSD',
                'slug' => 'samsung-990-pro-2tb-nvme',
                'brand' => 'Samsung',
                'type' => 'hardware',
                'price' => 6990.00,
                'stock' => 20,
                'description' => 'ไดรฟ์ SSD NVMe ตัวท็อป ประสิทธิภาพอ่านเขียนสูงสุด 7,450 / 6,900 MB/s พร้อมเทคโนโลยี V-NAND ล่าสุด',
                'specs' => [
                    'Form Factor' => 'M.2 2280',
                    'Interface' => 'PCIe Gen 4.0 x4, NVMe 2.0',
                    'Capacity' => '2TB (2,000GB)',
                    'Sequential Read' => '7,450 MB/s',
                    'Sequential Write' => '6,900 MB/s',
                    'Endurance' => '1,200 TBW',
                    'Controller' => 'Samsung Pascal Controller (8nm)',
                    'BuildCores ID' => 'samsung-990-pro-2tb',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B0BHJJ9Y77.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'storage-ssd',
                'name' => 'Inland Premium 512GB NVMe M.2 SSD',
                'slug' => 'inland-premium-512gb-nvme',
                'brand' => 'Inland',
                'type' => 'hardware',
                'price' => 1490.00,
                'stock' => 25,
                'description' => 'ไดรฟ์ M.2 NVMe PCIe 3.0 x4 ความจุ 512GB อ่านสูงสุด 3100 MB/s เขียนสูงสุด 1900 MB/s คุ้มค่าสำหรับติดตั้งระบบปฏิบัติการ',
                'specs' => [
                    'Form Factor' => 'M.2 2280',
                    'Interface' => 'PCIe Gen 3.0 x4, NVMe 1.3',
                    'Capacity' => '512GB',
                    'Flash Memory' => '3D TLC NAND Flash',
                    'Sequential Read' => 'Up to 3,100 MB/s',
                    'Sequential Write' => 'Up to 1,900 MB/s',
                    'BuildCores ID' => '0562e84c-35db-4e78-9e32-026c4f0397b2',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B07PB5C36M.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => false,
            ],

            // PC Cases (BuildCores OpenDB)
            [
                'category_slug' => 'pc-cases',
                'name' => 'LIAN LI B4 Mesh White Mid-Tower Case',
                'slug' => 'lian-li-b4-mesh-white',
                'brand' => 'Lian Li',
                'type' => 'hardware',
                'price' => 3890.00,
                'stock' => 11,
                'description' => 'เคสสีขาวระบายความร้อนสูงด้วยตาข่ายหน้าแบบ Mesh กระจกนิรภัยด้านข้าง มองเห็นอุปกรณ์ภายในอย่างชัดเจน',
                'specs' => [
                    'Chassis Type' => 'Mid Tower',
                    'Color' => 'Snow White',
                    'Motherboard Support' => 'ATX / Micro-ATX / Mini-ITX',
                    'Material' => 'Steel, Tempered Glass',
                    'Front Panel' => 'High Airflow Mesh',
                    'Radiator Support' => 'Front 360mm / Top 240mm',
                    'BuildCores ID' => 'df485a06-8fb5-4811-97b7-58e692cfab10',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B0GX5HP57Y.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'pc-cases',
                'name' => 'NZXT H5 Flow Starfield Edition Compact Mid-Tower',
                'slug' => 'nzxt-h5-flow-starfield-edition',
                'brand' => 'NZXT',
                'type' => 'hardware',
                'price' => 5490.00,
                'stock' => 5,
                'description' => 'เคสคอมพิวเตอร์ลิมิเต็ดอิดิชันธีม Starfield ระบบระบายความร้อนลมตรงสู่ GPU พร้อมพัดลมด้านล่างทำมุมเฉียง',
                'specs' => [
                    'Chassis Type' => 'Compact Mid-Tower',
                    'Theme' => 'Official Starfield Edition',
                    'GPU Clearance' => 'Up to 365 mm',
                    'Cooler Support' => 'CPU Cooler up to 165 mm',
                    'Drive Bays' => '1x 3.5-inch, 2x 2.5-inch',
                    'BuildCores ID' => 'nzxt-h5-flow-starfield',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B0CSSW795K.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => true,
            ],

            // PSU (BuildCores OpenDB)
            [
                'category_slug' => 'power-supply-psu',
                'name' => 'Corsair RM850 850W 80 PLUS Gold Fully Modular',
                'slug' => 'corsair-rm850-850w-gold-modular',
                'brand' => 'Corsair',
                'type' => 'hardware',
                'price' => 4590.00,
                'stock' => 18,
                'description' => 'พาวเวอร์ซัพพลาย 850W มาตรฐาน 80 PLUS Gold ถอดสายได้ทุกเส้น พัดลมระบายความร้อน Zero RPM เงียบสนิทเมื่อโหลดต่ำ',
                'specs' => [
                    'Wattage' => '850 Watts',
                    'Efficiency' => '80 PLUS Gold Certified',
                    'Modularity' => 'Fully Modular',
                    'Cooling Fan' => '135mm Rifle Bearing Fan with Zero RPM mode',
                    'Capacitors' => '105°C Rated Industrial Grade',
                    'Protection' => 'OVP, UVP, SCP, OTP, OPP',
                    'BuildCores ID' => '8b9195d5-8668-450f-bceb-ba9828ef05b4',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B07RCKG95L.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'power-supply-psu',
                'name' => 'SeaSonic PRIME TX-1600 Noctua Edition 1600W Titanium',
                'slug' => 'seasonic-prime-tx-1600-noctua-edition',
                'brand' => 'SeaSonic',
                'type' => 'hardware',
                'price' => 19900.00,
                'stock' => 4,
                'description' => 'พาวเวอร์ซัพพลายระดับไฮเอนด์ 1600W มาตรฐาน 80 PLUS Titanium ผสานพัดลม Noctua NF-A12x25 ประสิทธิภาพสูงสุดและเงียบที่สุด',
                'specs' => [
                    'Wattage' => '1600 Watts',
                    'Efficiency' => '80 PLUS Titanium Certified (94% efficiency)',
                    'Modularity' => 'Fully Modular with ATX 3.0 & PCIe 5.0 12V-2x6',
                    'Fan' => 'Noctua NF-A12x25 PWM 120mm Fan',
                    'Warranty' => '12 Years Manufacturer Warranty',
                    'BuildCores ID' => 'seasonic-prime-tx-1600-noctua',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B0DMW5F3GG.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => false,
            ],

            // SOFTWARE 1: OS (Verified Real Box Art)
            [
                'category_slug' => 'operating-systems',
                'name' => 'Microsoft Windows 11 Pro 64-bit English (FPP/Retail Box)',
                'slug' => 'windows-11-pro-fpp',
                'brand' => 'Microsoft',
                'type' => 'software',
                'price' => 7490.00,
                'stock' => 50,
                'description' => 'ระบบปฏิบัติการลิขสิทธิ์แท้ FPP สามารถย้ายเครื่องได้ รองรับ BitLocker, Windows Sandbox, Remote Desktop และฟีเจอร์ระดับองค์กร',
                'specs' => [
                    'License Type' => 'FPP (Full Packaged Product) / ย้ายเครื่องได้',
                    'System Architecture' => '64-bit Only',
                    'Media' => 'USB Flash Drive / Digital Key',
                    'Security' => 'BitLocker Drive Encryption, TPM 2.0',
                    'Language' => 'English / Multilingual',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B09WCNW54B.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'operating-systems',
                'name' => 'Microsoft Windows 11 Home 64-bit (OEM/COA)',
                'slug' => 'windows-11-home-oem',
                'brand' => 'Microsoft',
                'type' => 'software',
                'price' => 4290.00,
                'stock' => 40,
                'description' => 'Windows 11 Home ลิขสิทธิ์แท้แบบ OEM สำหรับประกอบเครื่องใหม่ ตอบโจทย์การใช้งานทั่วไป เกม และสตรีมมิ่ง',
                'specs' => [
                    'License Type' => 'OEM (ผูกกับเมนบอร์ดเครื่องแรก)',
                    'System Architecture' => '64-bit',
                    'Language' => 'English / Thai Supported',
                    'DirectX' => 'DirectX 12 Ultimate Support',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B09WCH4K8V.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => false,
            ],

            // SOFTWARE 2: Office (Verified Real Box Art)
            [
                'category_slug' => 'office-productivity',
                'name' => 'Microsoft 365 Family (6 Users / 1 Year Subscription)',
                'slug' => 'microsoft-365-family-1-year',
                'brand' => 'Microsoft',
                'type' => 'software',
                'price' => 2890.00,
                'stock' => 100,
                'description' => 'แชร์ได้สูงสุด 6 คน แต่ละคนได้พื้นที่คลาวด์ OneDrive 1TB พร้อมแอป Office เต็มรูปแบบบนคอมพิวเตอร์ แท็บเล็ต และสมาร์ทโฟน',
                'specs' => [
                    'Duration' => '1 Year Subscription',
                    'Users' => 'Up to 6 People',
                    'Cloud Storage' => '6 TB (1 TB per person)',
                    'Apps' => 'Word, Excel, PowerPoint, Outlook, OneDrive',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B08677HG15.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => true,
            ],

            // SOFTWARE 3: Security (Verified Real Box Art)
            [
                'category_slug' => 'security-antivirus',
                'name' => 'Kaspersky Plus 2026 (3 Devices / 1 Year)',
                'slug' => 'kaspersky-plus-3-devices-1-year',
                'brand' => 'Kaspersky',
                'type' => 'software',
                'price' => 990.00,
                'stock' => 60,
                'description' => 'ระบบป้องกันไวรัสและภัยคุกคามไซเบอร์แบบเรียลไทม์ พร้อม VPN ความเร็วสูงไม่จำกัด และเครื่องมือเพิ่มความเร็วคอมพิวเตอร์',
                'specs' => [
                    'Devices' => '3 Devices (Windows, macOS, Android, iOS)',
                    'Validity' => '1 Year',
                    'Features' => 'Anti-Malware, Ransomware Protection, Unlimited VPN, Performance Optimization',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B09HM9W99P.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => false,
            ],
            [
                'category_slug' => 'security-antivirus',
                'name' => 'Norton 360 Deluxe (5 Devices / 1 Year)',
                'slug' => 'norton-360-deluxe-5-devices',
                'brand' => 'Norton',
                'type' => 'software',
                'price' => 1290.00,
                'stock' => 45,
                'description' => 'การปกป้องรอบด้านสำหรับพีซี แมค สมาร์ตโฟน และแท็บเล็ต พร้อม Cloud Backup 50GB และ Secure VPN',
                'specs' => [
                    'Devices' => 'Up to 5 PCs, Macs, Smartphones, Tablets',
                    'Validity' => '1 Year Subscription',
                    'Cloud Backup' => '50 GB PC Cloud Backup',
                    'Features' => 'Real-time Threat Protection, Secure VPN, Dark Web Monitoring, Password Manager',
                ],
                'image_url' => 'https://images-na.ssl-images-amazon.com/images/P/B09257C9L7.01._SCLZZZZZZZ_SX800_.jpg',
                'is_featured' => true,
            ],
        ];

        // Prune old mock / broken products not in verified catalog
        $validSlugs = array_column($products, 'slug');
        Product::whereNotIn('slug', $validSlugs)->delete();

        foreach ($products as $prod) {
            $catSlug = $prod['category_slug'];
            unset($prod['category_slug']);
            $prod['category_id'] = $createdCategories[$catSlug]->id;

            Product::updateOrCreate(
                ['slug' => $prod['slug']],
                $prod
            );
        }
    }
}
