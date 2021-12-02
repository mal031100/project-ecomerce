<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = [
        'name',
        'description',
        'category_id',
    ];

    public function cate(){
        return $this->hasMany(Category::class);
    }

    public function catebrand(){
        return $this->hasMany(CategoryBrand::class, 'category_id', 'id');
    }

    public function pro(){
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
