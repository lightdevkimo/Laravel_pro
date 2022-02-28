<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=> Str::random(5),
            'email'=> Str::random(5).'@mail.com',
            'gender'=> 'male',
            'password'=> Hash::make('12345678')
        ]);
        DB::table('users')->insert([
            'name'=> Str::random(5),
            'email'=> Str::random(5).'@mail.com',
            'gender'=> 'male',
            'password'=> Hash::make('12345678')
        ]);
        DB::table('users')->insert([
            'name'=> Str::random(5),
            'email'=> Str::random(5).'@mail.com',
            'gender'=> 'female',
            'password'=> Hash::make('12345678')
        ]);
        DB::table('users')->insert([
            'name'=> Str::random(5),
            'email'=> Str::random(5).'@mail.com',
            'gender'=> 'female',
            'password'=> Hash::make('12345678')
        ]);
    }
}
