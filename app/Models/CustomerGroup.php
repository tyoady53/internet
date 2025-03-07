<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class, 'group_id')->orderBy('join_date','DESC');
    }
}
