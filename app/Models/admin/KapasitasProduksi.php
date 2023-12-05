<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KapasitasProduksi extends Model
{
    use HasFactory;
    protected $table = 'kapasitas_produksis';
    protected $fillable = [
        'judul',
        'image',
        'description'
    ];
}
