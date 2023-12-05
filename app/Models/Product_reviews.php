<?php

namespace App\Models;

use App\Models\admin\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product_reviews extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'product_id',
        'rate',
        'review',
        'status'
    ];

    public function user_info(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public static function getAllReview(){
        return Product_reviews::with('user_info')->get();
    }
    public static function getAllUserReview(){
        return Product_reviews::where('user_id',auth()->user()->id)->with('user_info')->get();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
