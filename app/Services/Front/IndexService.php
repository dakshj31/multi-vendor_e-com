<?php 

namespace App\Services\Front;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;

class IndexService
{
    public function getHomePageBanners()
    {
        $homeSliderBanners = Banner::where('type', 'Slider')
        ->where('status', 1)
        ->orderBy('sort', 'Desc')
        ->get()
        ->toArray();

        $homeFixBanners = Banner::where('type', 'Fix')
        ->where('status', 1)
        ->orderBy('sort', 'Desc')
        ->get()
        ->toArray();

        $logoBanners = Banner::where('type', 'Logo')
        ->where('status', 1)
        ->orderBy('sort', 'Desc')
        ->get()
        ->toArray();

        return compact('homeSliderBanners', 'homeFixBanners', 'logoBanners');
    }

    public function featuredProducts()
    {
        $featuredProducts = Product::select('id', 'category_id', 'product_name', 'discount_applied_on', 'product_price', 'product_discount', 'final_price', 'group_code', 'main_image')
        ->with(['product_images'])
        ->where(['is_featured'=>'Yes', 'status'=> 1])
        ->where('stock', '>', 0)
        ->inRandomOrder()
        ->limit(8)
        ->get()
        ->toArray();

        return compact('featuredProducts');
    }

    public function newArrivalProducts()
    {
        $newArrivalProducts = Product::select('id', 'category_id', 'product_name', 'discount_applied_on', 'product_price', 'product_discount', 'final_price', 'group_code', 'main_image')
        ->with(['product_images'])
        ->where('status', 1)
        ->where('stock', '>', 0)
        ->latest()
        ->orderBy('id','Desc')
        ->limit(8)
        ->get()
        ->toArray();

        return compact('newArrivalProducts');
    }

    public function homeCategories()
    {
        $categories = Category::select('id', 'name', 'image', 'url')
        ->whereNull('parent_id') // only fetch top-level (parent) categories
        ->where('status', 1)  // only active categories
        ->where('menu_status', 1)  // only categories marked to show on menu/homepage
        ->get()
        ->map(function ($category) {
            $allCategoryIds = $this->getAllCategoryIds($category->id); // Get this Category + its subcategory IDs
            $productCount = Product::whereIn('category_id', $allCategoryIds)
            ->where('status', 1)
            ->where('stock', '>', 0)
            ->count(); // Count active + in-stock products across all levels
            return [
                'id' => $category->id,
                'name' => $category->name,
                'image' => $category->image,
                'url' => $category->url,
                'product_count' => $productCount // Attach product count in each category
            ];
        });
        return ['categories' => $categories->toArray()];

    }

    private function getAllCategoryIds($parentId)
    {
        $categoryIds = [$parentId]; //Start with the current parent category
        $childIds = Category::where('parent_id', $parentId)
        ->where('status', 1)
        ->pluck('id'); // Get child category IDs
        foreach ($childIds as $childId) {
            $categoryIds = array_merge($categoryIds, $this->getAllCategoryIds($childId)); // recursive to get sub-subcategories
        }
        return $categoryIds; //return all chhild + sub-child category IDs
    }
}