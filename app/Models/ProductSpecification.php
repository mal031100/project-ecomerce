<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model
{
    use HasFactory;

    protected $table = 'product_specification';
    protected $fillable = [
        'product_id',
        'specification_id',
        'parameter',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function spec(){
        return $this->belongsTo(Specification::class, 'specification_id', 'id');
    }
}
