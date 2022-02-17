<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'money_received',
        'change',
        'total_price',
        'total_item',
        'date',
        'status'
    ];

    public function nameuser()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function order_detail()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }


}
