<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('files')->insert([
            'user_id' => 1,
            'file_path' => 'first_sample_file',
        ]);
        DB::table('files')->insert([
            'user_id' => 2,
            'file_path' => 'second_sample_file',
        ]);
        DB::table('files')->insert([
            'user_id' => 3,
            'file_path' => 'third_sample_file',
        ]);
        DB::table('files')->insert([
            'user_id' => 3,
            'file_path' => 'fourth_sample_file',
        ]);
    }
}
