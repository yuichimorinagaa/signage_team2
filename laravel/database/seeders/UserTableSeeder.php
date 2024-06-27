<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'email'=>'inagaki@social-db.co.jp',
            'password'=>Hash::make('password'),
            'status'=>1
        ]);
        DB::table('users')->insert([
            'email'=>'morinaga@social-db.co.jp',
            'password'=>Hash::make('password'),
            'status'=>1
        ]);
        DB::table('users')->insert([
            'email'=>'furukawa@social-db.co.jp',
            'password'=>Hash::make('password'),
            'status'=>1
        ]);
    }
}
