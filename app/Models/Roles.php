<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Roles extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'role_name'
    ];



    public function users(){
        return $this->hasMany(User::class,'roles_id','id');
    }

}
