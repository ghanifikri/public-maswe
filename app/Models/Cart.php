<?php

namespace App\Models;

use App\Models\admin\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'product_id',
        'size',
        'quant',
        'amount',
        'price'
    ];

    public function product(){
        return $this->hasOne( Product::class, 'id', 'product_id' );
    }

    public function user(){
        return $this->belongsTo( User::class, 'user_id', 'id');
    }
}
