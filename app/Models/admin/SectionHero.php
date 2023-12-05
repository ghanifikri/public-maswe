<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionHero extends Model
{
    use HasFactory;

    protected $table = 'section_heroes';
    protected $fillable = [
        'id_section',
        'title',
        'title_link',
        'description',
        'background'
    ];
}
