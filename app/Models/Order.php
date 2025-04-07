<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $table = 'orders';

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'user_id',
        'total_price',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderProducts(){
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

}
