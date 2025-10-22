<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class color extends Model
{
    public static function colors() {
        return Color::where('status', 1)->get();
    }
}
