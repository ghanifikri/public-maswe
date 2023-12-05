<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasProduksi extends Model
{
    use HasFactory;
    protected $table = 'fasilitas_produksis';
    protected $fillable = [
        'nama_fasilitas',
        'image',
        'description'
    ];
}
