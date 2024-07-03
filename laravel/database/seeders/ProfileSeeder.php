<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('profiles')->insert([
            'name' => '稲垣勇悟',
            'grade' => '大学1年',
            'university' => '慶應義塾大学　法学部政治学科',
            'profile_photo_path' => 'profile_photo/default.png',
            'joining_date' => '2024-06-11',
            'comment' => 'テニスやってます！エンジニア歴は入社してからです！開発がんばります！',
        ]);
    }
}
