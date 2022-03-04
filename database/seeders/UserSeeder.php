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
            'name'=>'Super Admin',
            'email'=> 'admin@sakn.com',
            'gender'=> 'male',
            'role'=>'0',
            'password'=> bcrypt('admin@123')
        ]);
        DB::table('users')->insert([
            'name'=> 'Owner',
            'email'=> 'owner@sakn.com',
            'gender'=> 'male',
            'role'=>'2',
            'password'=> bcrypt('owner@123')
        ]);
        DB::table('users')->insert([
            'name'=> 'User2',
            'email'=> 'user1@sakn.com',
            'gender'=> 'male',
            'role'=>'1',
            'password'=> bcrypt('user@123')
        ]);
        DB::table('users')->insert([
            'name'=> 'User2',
            'email'=> 'user2@sakn.com',
            'gender'=> 'female',
            'role'=>'1',
            'password'=> bcrypt('user@123')
        ]);

    }
}
