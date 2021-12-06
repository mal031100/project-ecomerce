<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryBrand extends Model
{
    use HasFactory;

    protected $table = 'category_brand';
    protected $fillable = [
        'category_id',
        'brand_id',
    ];
    
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function brands(){
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
}
