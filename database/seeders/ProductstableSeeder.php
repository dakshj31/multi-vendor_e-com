<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;

class ProductstableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menTShirtsCategory = Category::where('name', 'Men T-Shirts')->first();
        if($menTShirtsCategory) {
            Product::create([
                'category_id' => $menTShirtsCategory->id,
                'brand_id' => 1,
                'admin_id' => 1,
                'admin_role' => 'admin',
                'product_name' => 'Blue T-shirt',
                'product_code' => 'BTS001',
                'product_color' => 'Dark Blue',
                'family_color' => 'Blue',
                'group_code' => 'b001',
                'product_price' => '1000',
                'product_discount' => '10',
                'product_discount_amount' => '100',
                'discount_applied_on' => 'product',
                'product_gst' => '12',
                'final_price' => '900',
                'main_image' => '',
                'product_weight' => '500',
                'product_video' => '',
                'description' => 'Test Product',
                'wash_care' => '',
                'search_keywords' => '',
                'fabric' => '',
                'pattern' => '',
                'sleeve' => '',
                'fit' => '',
                'occasion' => '',
                'stock' => '10',
                'sort' => '1',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'is_featured' => 'No',
                'status' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            Product::create([
                'category_id' => $menTShirtsCategory->id,
                'brand_id' => 1,
                'admin_id' => 1,
                'admin_role' => 'admin',
                'product_name' => 'Red T-shirt',
                'product_code' => 'RTS001',
                'product_color' => 'Red',
                'family_color' => 'Red',
                'group_code' => 'r001',
                'product_price' => '2000',
                'product_discount' => '10',
                'product_discount_amount' => '200',
                'discount_applied_on' => 'product',
                'product_gst' => '12',
                'final_price' => '1800',
                'main_image' => '',
                'product_weight' => '500',
                'product_video' => '',
                'description' => 'Test Product',
                'wash_care' => '',
                'search_keywords' => '',
                'fabric' => '',
                'pattern' => '',
                'sleeve' => '',
                'fit' => '',
                'occasion' => '',
                'stock' => '10',
                'sort' => '2',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'is_featured' => 'Yes',
                'status' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
