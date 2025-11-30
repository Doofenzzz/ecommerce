<?php
    
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['code' => 'PRD001', 'name' => 'Indomie Goreng', 'category' => 'Makanan', 'purchase_price' => 2500, 'selling_price' => 3000, 'stock' => 100, 'unit' => 'pcs'],
            ['code' => 'PRD002', 'name' => 'Aqua 600ml', 'category' => 'Minuman', 'purchase_price' => 3000, 'selling_price' => 4000, 'stock' => 50, 'unit' => 'botol'],
            ['code' => 'PRD003', 'name' => 'Teh Pucuk', 'category' => 'Minuman', 'purchase_price' => 4000, 'selling_price' => 5000, 'stock' => 30, 'unit' => 'botol'],
            ['code' => 'PRD004', 'name' => 'Chitato Rasa Sapi Panggang', 'category' => 'Snack', 'purchase_price' => 8000, 'selling_price' => 10000, 'stock' => 25, 'unit' => 'pcs'],
            ['code' => 'PRD005', 'name' => 'Susu Ultra Coklat', 'category' => 'Minuman', 'purchase_price' => 5000, 'selling_price' => 6500, 'stock' => 4, 'unit' => 'kotak'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
