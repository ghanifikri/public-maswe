<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    use HasFactory;
    protected $table = 'teams';
    protected $fillable = [
        'nama',
        'image',
        'jabatan',
        'facebook',
        'gmail',
        'instagram'
    ];
}
