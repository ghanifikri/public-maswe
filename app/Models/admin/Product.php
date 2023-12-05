<?php

namespace App\Models\admin;

use App\Models\Product_reviews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'kategori',
        'summary',
        'description',
        'price'
    ];

     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

     public function getReview()
     {
        return $this->hasMany(Product_reviews::class,'product_id','id')->with('user_info')->where('status','active')->orderBy('id','DESC');
     }

     public static function getProductBySlug($slug)
     {
        return Product::with(['getReview'])->where('slug', $slug)->first();
     }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
