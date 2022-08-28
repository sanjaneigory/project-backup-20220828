<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Insert information into the DatabaseSeeder

        DB::table('users')->insert([
            'name' => 'Igor Sanjane',
            'email' => 'igor.asanjane@gmail.com',
            'password' => bcrypt('G%Xt2;5hRB.WuUHU'),
        ]);
    }
}
