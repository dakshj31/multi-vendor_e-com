<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductsFilter extends Model
{
    public static function getColors($catIds)
    {
        $getProductIds = Product::select('id')->whereIn('category_id', $catIds)->pluck('id')->toArray();
        if (empty($getProductIds)) {
            return [];
        }
        $getProductColors = Product::select('family_color')
        ->whereIn('id', $getProductIds)
        ->whereNotNull('family_color')
        ->groupBy('family_color')
        ->pluck('family_color')
        ->toArray();

        return $getProductColors ?? [];
    }

    public static function getSizes($catIds)
    {
        $getProductIds = Product::select('id')
        ->whereIn('category_id', $catIds)
        ->pluck('id')
        ->toArray();
        if (empty($getProductIds)) {
            return [];
        }
        $getProductSizes = ProductsAttribute::select('size')
        ->where('status', 1)
        ->whereIn('product_id', $getProductIds)
        ->groupBy('size')
        ->pluck('size')
        ->toArray();

        return $getProductSizes ?? [];
    }
}
