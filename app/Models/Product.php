<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $filllable = [
        'category_id',
        'user_id',
        'name',
        'price',
        'amount',
        'image',
        'sale',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function orderdetail(){
        return $this->hasMany(OrderDetail::class, 'produc_id', 'id');
    }

    public function prospec(){
        return $this->hasOne(ProductSpecification::class, 'product_id', 'id');
    }
}
