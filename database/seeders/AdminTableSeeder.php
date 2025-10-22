<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $password = Hash::make('123456');
        $admin = new Admin;
        $admin->name = 'Daksh Joshi';
        $admin->role = 'admin';
        $admin->mobile = '8178745897';
        $admin->email = 'daksh@gmail.com';
        $admin->password = $password;
        $admin->status = 1;
        $admin->save();

        
        $admin = new Admin;
        $admin->name = 'Tony';
        $admin->role = 'subadmin';
        $admin->mobile = '817878952';
        $admin->email = 'tony@gmail.com';
        $admin->password = $password;
        $admin->status = 1;
        $admin->save();

        
        $admin = new Admin;
        $admin->name = 'Steve';
        $admin->role = 'subadmin';
        $admin->mobile = '8178965723';
        $admin->email = 'steve@gmail.com';
        $admin->password = $password;
        $admin->status = 1;
        $admin->save();
        
    }
}
