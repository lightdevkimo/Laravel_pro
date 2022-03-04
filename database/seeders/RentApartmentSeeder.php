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
            'user_id' => 3,
            'apartment_id' => 1,
            'comments' => 'Good Apartement',
            'status' => 'requested'
        ]);
        DB::table('rented_apartments')->insert([
            'user_id' => 4,
            'apartment_id' => 2,
            'comments' => 'Bad Apartement',
            'status' => 'requested'
        ]);
    }
}
