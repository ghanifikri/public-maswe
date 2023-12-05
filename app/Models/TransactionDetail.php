<?php

namespace App\Models;

use App\Models\admin\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $table = 'transaction_details';
    protected $fillable = [
        'code',
        'transaction_id',
        'product_id',
        'quant',
        'price',
        'amount',
        'size'
    ];

    /**
     * Get the user that owns the TransactionDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function Transaction(): BelongsTo
    // {
    //     return $this->belongsTo(Transaction::class);
    // }

    public function transaction(){
        return $this->hasOne( Transaction::class, 'id', 'transaction_id' );
    }

    /**
     * Get the user that owns the TransactionDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
