<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePlay extends Model
{
    use HasFactory;
    protected $guarded = [
    ];

    public function groups(){
        return $this->hasMany(RolePlay::class,'user_id','id');
    }
}
