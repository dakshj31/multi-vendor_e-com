<?php 

namespace App\Services\Front;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\View;

class ProductService
{
    public function getCategoryListingData($url)
    {
        $categoryInfo = Category::categoryDetails($url);

        $query = Product::with(['product_images'])
        ->whereIn('category_id', $categoryInfo['catIds'])
        ->where('status', 1);
        
        // Apply filters (sort)
        $query = $this->applyFilters($query);
        
        $products = $query->paginate(3)->withQueryString();

        return [
            'categoryDetails' => $categoryInfo['categoryDetails'],
            'breadcrumbs' => $categoryInfo['breadcrumbs'],
            'categoryProducts' => $products,
            'selectedSort' => request()->get('sort', 'latest'),
            'url' => $url
        ];
    }

    private function applyFilters($query)
    {
        $sort = request()->get('sort');
        switch ($sort) {
            case 'product_latest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'lowest_price':
                $query->orderBy('final_price', 'asc');
                break;
            case 'highest_price':
                $query->orderBy('final_price', 'desc');
                break;
            case 'best_selling':
                $query->inRandomOrder();
                break;
            case 'featured_items':
                $query->where('is_featured', 'Yes')->orderBy('created_at', 'desc');
                break;
            case 'discounted_items':
                $query->where('product_discount', '>', 0);
                break;    
            default:
                $query->orderBy('created_at', 'desc');          
        }
        return $query;
    }
}