<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    protected $table = 'people';
    protected $fillable = [
        'nama',
        'image',
        'jabatan',
        'facebook',
        'gmail',
        'instagram'
    ];
}
