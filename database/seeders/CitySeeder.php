<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            'name'=> 'Smart',
            'governorate' => 'Cairo'
        ]);
        DB::table('cities')->insert([
            'name'=> 'Sidi Gaber',
            'governorate' => 'Alex'
        ]);
        DB::table('cities')->insert([
            'name'=> 'Luxor',
            'governorate' => 'Luxor'
        ]);
    }
}
