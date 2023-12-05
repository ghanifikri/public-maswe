<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Founder extends Model
{
    use HasFactory;
    protected $table = 'founders';
    protected $fillable = [
        'nama',
        'image',
        'jabatan',
        'facebook',
        'gmail',
        'instagram'
    ];
}
