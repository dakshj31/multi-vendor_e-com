<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Filter;
use App\Models\FilterValue;

class FilterstableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fabric = Filter::create(['filter_name' => 'Fabric', 'sort' => 1, 'status' => 1]);
        $sleeve = Filter::create(['filter_name' => 'Sleeve', 'sort' => 2, 'status' => 1]);
        FilterValue::insert([
            ['filter_id' => $fabric->id, 'value' => 'Cotton', 'sort' => 1, 'status' => 1],
            ['filter_id' => $fabric->id, 'value' => 'Polyester', 'sort' => 2, 'status' => 1],
            ['filter_id' => $sleeve->id, 'value' => 'Full Sleeve', 'sort' => 1, 'status' => 1],
            ['filter_id' => $sleeve->id, 'value' => 'Half Sleeve', 'sort' => 2, 'status' => 1],
        ]);
    }
}
