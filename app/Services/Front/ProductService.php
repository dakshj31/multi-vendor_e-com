<?php 

namespace App\Services\Front;

use App\Models\Category;
use App\Models\Product;

class ProductService
{
    public function getCategoryListingData($url)
    {
        $categoryInfo = Category::categoryDetails($url);

        $query = Product::with(['product_images'])
        ->whereIn('category_id', $categoryInfo['catIds'])
        ->where('status', 1);
        $query = $this->applyFilters($query);
        $products = $query->paginate(12)->withQueryString();

        return [
            'categoryDetails' => $categoryInfo['categoryDetails'],
            'breadcrumbs' => $categoryInfo['breadcrumbs'],
            'categoryProducts' => $products,
            'selectedSort' => request()->get('sort', 'latest'),
        ];
    }

    private function applyFilters($query)
    {
        $sort = request()->get('sort');
        switch ($sort) {
            case 'latest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'low_to_high':
                $query->orderBy('final_price', 'asc');
                break;
            case 'high_to_low':
                $query->orderBy('final_price', 'desc');
                break;
            case 'best_selling':
                $query->inRandomOrder();
                break;
            case 'featured':
                $query->where('is_featured', 'Yes')->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');          
        }
        return $query;
    }
}