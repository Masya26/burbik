<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'title',
        'product_image',
        'price',
        'count',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
    public function getCategory()
    {
        return Category::find($this->category_id);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products', 'product_id', 'order_id');
    }
    public function toArray()
    {
        $array = parent::toArray();

        // Если есть отношение с категорией, добавляем атрибуты категории в массив
        if ($this->category) {
            $array['category'] = $this->category->toArray();
        }

        return $array;
    }
}
