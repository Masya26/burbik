<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total_price'];

    public function products()
    {
        return $this->belongsToMany(Products::class, 'order_products', 'order_id', 'product_id')->withPivot('quantity');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
