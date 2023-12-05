<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $table = 'attributes';
    protected $fillable = [
        'kode',
        'name'
    ];

    public function attributeValue()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
