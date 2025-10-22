<?php 

namespace App\Services\Front;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsAttribute;
use App\Models\Brand;
use App\Models\Filter;
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

        // Fetch filters with values
        $filters = Filter::with(['values' => function($q){
            $q->where('status', 1)->orderBy('sort', 'asc');    
        }])->where('status', 1)->orderBy('sort', 'asc')->get();

        return [
            'categoryDetails' => $categoryInfo['categoryDetails'],
            'breadcrumbs' => $categoryInfo['breadcrumbs'],
            'categoryProducts' => $products,
            'selectedSort' => request()->get('sort', 'latest'),
            'url' => $url,
            'catIds' => $categoryInfo['catIds'],
            'filters' => $filters,
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

        // Apply Size Filter
        if (request()->has('size') && !empty(request()->get('size'))) {
            $sizes = explode('~', request()->get('size'));
            $getProductsIds = ProductsAttribute::select('product_id')
            ->whereIn('size', $sizes)
            ->pluck('product_id')
            ->toArray();
            if(!empty($getProductsIds)) {
                $query->whereIn('id', $getProductsIds);
            }
        }

        // Apply Brand Filter
        if (request()->has('brand') && !empty(request()->get('brand'))) {
            $brands = explode('~', request()->get('brand'));
            $getBrandIds = Brand::select('id')
            ->whereIn('name', $brands)
            ->pluck('id')
            ->toArray(); 
            $query->whereIn('brand_id', $getBrandIds);
        }

        // Apply Price Filter
        if (request()->has('price') && !empty(request()->get('price'))) {
            $priceInput = str_replace("~","-", request()->get('price'));
            $prices = explode('-', $priceInput);
            $count = count($prices);
            if($count >= 2){
                $query->whereBetween('final_price', [(int)$prices[0], (int)$prices[$count-1]]);
            }
            
        }

        // Apply Dynamic Admin Filters (Fabric,Sleeve, etc.)
        $filterParams = request()->all();

        foreach ($filterParams as $filterKey => $filterValues) {
            // Skip known default filters(color, size, brand, price, sort, page, json)
            if (in_array($filterKey, ['color', 'size', 'brand', 'price', 'sort', 'page', 'json']))
            {
                continue;
            }

            // Filter values can be "~" seprated
            $selectedValues = explode('~', $filterValues);

            if (!empty($selectedValues)) {
                $query->whereHas('filterValues', function($q) use ($selectedValues) {
                    $q->whereIn('value', $selectedValues);
                });
            }
        }

        return $query;
    }
}