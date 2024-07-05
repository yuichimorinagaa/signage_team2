<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profiles';
    protected $fillable = [
        'name',
        'grade',
        'university',
        'profile_photo_path',
        'joining_date',
        'comment',
        'hobbies',
        'mbti',
        'high_school',
        'hometown',
        'birthday',
        'motto',
        'restaurants',
        'club_activities',
        'famous_person',
        'artists',
        'if_ceo',
        ];

}
