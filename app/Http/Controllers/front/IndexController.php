<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Front\IndexService;

class IndexController extends Controller
{

    protected $indexService;
    public function __construct(IndexService $indexService)
    {
        $this->indexService = $indexService;
    }

    public function index()
    {
        $banners = $this->indexService->getHomePageBanners();
        return view('front.index')->with($banners);
    }
}
