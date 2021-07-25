<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video_category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
    ];

    protected $table = "video_category";
}
