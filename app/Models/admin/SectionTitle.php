<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionTitle extends Model
{
    use HasFactory;
    protected $table = 'section_titles';
    protected $fillable = [
        'id_title',
        'title',
        'sub_title',
        'background'
    ];
}
