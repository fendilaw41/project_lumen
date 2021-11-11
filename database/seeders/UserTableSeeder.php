<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "fendilaw",
            'email' => "fendilaw@gmail.com",
            "password" => app('hash')->make('password'),
        ]);
    }
}
