<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderVideo extends Model
{
    use HasFactory;
    protected $table = 'header_videos';
    protected $fillable = [
        'title',
        'sub_title',
        'video'
    ];
}
