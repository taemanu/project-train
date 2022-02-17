<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'pd_code',
        'pd_name',
        'pd_image',
        'pd_price',
        'pd_amount',
        'pd_minimum',
        'status',
        'cate_id'
    ];

    public function cates(){
        return $this->belongsTo(Categories::class,'cate_id','id');
    }

    public function stock()
    {
        return $this->hasMany(stock::class,'pd_id','id');
    }

}



