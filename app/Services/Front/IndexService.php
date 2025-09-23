<?php 

namespace App\Services\Front;

use App\Models\Banner;

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
}