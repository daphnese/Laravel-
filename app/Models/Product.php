<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'image',
        'name',
        'category_id',
        'price',
        'description',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function orderProducts(){
        return $this->hasMany(OrderProduct::class, 'product_id');
    }
}
