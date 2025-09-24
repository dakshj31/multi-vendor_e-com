<?php 

namespace App\Services\Front;

use App\Models\Banner;
use App\Models\Product;

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

        return compact('homeSliderBanners', 'homeFixBanners');
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
}