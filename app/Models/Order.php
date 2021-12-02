<?php

namespace App\Models;

use Facade\Ignition\DumpRecorder\Dump;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'order_code',
        'full_name',
        'phone',
        'address',
        'status',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderdetail(){
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
