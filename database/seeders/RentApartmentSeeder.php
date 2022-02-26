<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rented_apartments')->insert([
            'user_id' => 1,
            'apartment_id' => 1,
            'comments' => '',
            'status' => 'requested'
        ]);
    }
}
