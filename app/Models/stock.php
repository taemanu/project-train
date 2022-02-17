<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'pd_id',
        'user_id',
        'before_amount',
        'stock_amount',
        'after_amount',
        'status_status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'pd_id','id');
    }

    public function nameuser()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
