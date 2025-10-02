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
            'url' => $url,
            'catIds' => $categoryInfo['catIds']
        ];
    }

    private function applyFilters($query)
    {
        // Apply Sorting Filter
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

        // Apply Color Filter
        if(request()->has('color') && !empty(request()->get('color'))) {
            $colors = array_filter(explode('~',request()->get('color')));
            if(count($colors) > 0){
                $query->whereIn('family_color', $colors);
            }
        }
        return $query;
    }
}