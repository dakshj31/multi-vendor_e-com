<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;
use Carbon\Carbon;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bannerRecords = [
            ['type'=>'Slider', 'image'=>'carousel-1.jpg', 'link'=>'', 'title'=>'Products on Sale', 'alt'=>'Products on Sale', 'sort'=>1, 'status'=>1],
            ['type'=>'Slider', 'image'=>'carousel-2.jpg', 'link'=>'', 'title'=>'Flat 50% Off', 'alt'=>'Flat 50% Off', 'sort'=>2, 'status'=>1],
            ['type'=>'Slider', 'image'=>'carousel-3.jpg', 'link'=>'', 'title'=>'Summer Sale', 'alt'=>'Summer Sale', 'sort'=>1, 'status'=>1],
        ];
        foreach ($bannerRecords as $record) {
            Banner::create($record);
        }
    }
}
