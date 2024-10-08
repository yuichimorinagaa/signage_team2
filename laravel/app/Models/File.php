<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'file_path',
        'status',
    ];

    const STATUS_NOT_SELECTED = 0;
    const STATUS_SELECTED = 1;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
