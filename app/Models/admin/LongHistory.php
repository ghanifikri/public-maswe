<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LongHistory extends Model
{
    use HasFactory;

    protected $table = 'long_histories';
    protected $fillable = [
        'title',
        'description',
        'image'
    ];
}
