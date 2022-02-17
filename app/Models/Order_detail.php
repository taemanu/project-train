<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'order_id',
        'amount',
        'price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function order()
    {
        return $this->hasMany(Order::class,'order_id','id');
    }





}
