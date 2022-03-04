<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ApartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('apartments')->insert([
            
            'approved' => 1,
            'description' => 'desc',
            'address' => 'addr',
            'price' => 1000,
            'link' => '',
            'gender' => 'male',
            'images' => Str::random(10).'.png',
            'available' => 2,
            'max' => 2,
            'nearby' => '',
            'owner_id' => 2,
            'city_id' => 1,
        ]);
        DB::table('apartments')->insert([
            
            'approved' => 1,
            'description' => 'desc',
            'address' => 'addr',
            'price' => 2000,
            'link' => '',
            'gender' => 'female',
            'images' => Str::random(10).'.png',
            'available' => 1,
            'max' => 1,
            'nearby' => '',
            'owner_id' => 2,
            'city_id' => 2,
        ]);
    }
}
