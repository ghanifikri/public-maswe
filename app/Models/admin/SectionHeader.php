<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionHeader extends Model
{
    use HasFactory;
    protected $table = 'section_headers';
    protected $fillable = [
        'id_section',
        'title',
        'sub_title'
    ];
}
