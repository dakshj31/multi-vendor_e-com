<?php 

namespace App\Services\Front;

use App\Models\Category;
use App\Models\Product;

class ProductService
{
    public function getCategoryListingData($url)
    {
        $categoryInfo = Category::categoryDetails($url);

        $products = Product::with(['product_images'])
        ->whereIn('category_id', $categoryInfo['catIds'])
        ->where('status', 1)
        ->paginate(3);

        return [
            'categoryDetails' => $categoryInfo['categoryDetails'],
            'breadcrumbs' => $categoryInfo['breadcrumbs'],
            'categoryProducts' => $products,
        ];
    }
}