<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'sku' => 'MON001',
                'name' => 'Monitor 24 inch',
                'price' => 2500000,
                'reference' => 'LG24',
            ],
            [
                'sku' => 'RTR001',
                'name' => 'Router N300',
                'price' => 750000,
                'reference' => 'TP-Link',
            ],
            [
                'sku' => 'CPU001',
                'name' => 'CPU Intel i5',
                'price' => 7000000,
                'reference' => 'Asus',
            ],
            [
                'sku' => 'KBD001',
                'name' => 'Keyboard Mekanik',
                'price' => 500000,
                'reference' => 'Logitech',
            ],
            [
                'sku' => 'MSE001',
                'name' => 'Mouse Gaming',
                'price' => 350000,
                'reference' => 'Razer',
            ],
            [
                'sku' => 'PRN001',
                'name' => 'Printer Inkjet',
                'price' => 1500000,
                'reference' => 'Epson',
            ],
            [
                'sku' => 'UPS001',
                'name' => 'UPS 600VA',
                'price' => 800000,
                'reference' => 'APC',
            ],
            [
                'sku' => 'HDD001',
                'name' => 'Hard Disk 1TB',
                'price' => 1200000,
                'reference' => 'Seagate',
            ],
            [
                'sku' => 'SSD001',
                'name' => 'SSD 500GB',
                'price' => 1800000,
                'reference' => 'Samsung',
            ],
            [
                'sku' => 'CAM001',
                'name' => 'Webcam HD',
                'price' => 600000,
                'reference' => 'Logitech',
            ],
        ];

        // Menambahkan data ke tabel products
        DB::table('products')->insert($products);
    }
}
