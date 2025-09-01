<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id')->with('parentcategory');
    }

    public function product_images() {
        return $this->hasMany(ProductImage::class)->orderBy('sort', 'asc');
    }

    public function attributes() {
        return $this->hasMany('App\Models\ProductsAttribute');
    }
}
