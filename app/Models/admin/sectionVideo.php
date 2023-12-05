<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sectionVideo extends Model
{
    use HasFactory;

    protected $table = 'section_videos';
    protected $fillable = [
        'id_section',
        'title_one',
        'title_two',
        'title_three',
        'title_four',
        'video_url',
        'background'
    ];
}
