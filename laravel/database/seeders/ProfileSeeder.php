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
            'profile_photo_path' => '/storage/app/public/profile_photo/default.png',
            'joining_date' => '2024-06-11',
            'comment' => 'テニスやってます！エンジニア歴は入社してからです！開発がんばります！',
            'hobbies' => 'スポーツ観戦（野球、テニス）、お笑いを見ること',
            'mbti' => 'ENTJ-T',
            'high_school' => '慶應義塾高校',
            'hometown' => '広島生まれ神奈川育ち',
            'birthday' => '2005-08-25',
            'motto' => '結果の出ない努力は自己満足に過ぎない',
            'restaurants' => 'がっとん',
            'club_activities' => 'テニス部',
            'famous_person' => 'パンクブーブー',
            'artists' => 'King Gnu',
            'if_ceo' => '会社を大きくできるようにがんばります',
        ]);
    }
}
