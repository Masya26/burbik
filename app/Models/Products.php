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
    public function getCategory() {
        return Category::find($this->category_id);
    }
}
