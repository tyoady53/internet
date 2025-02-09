<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function package()
    {
        return $this->belongsTo(MasterBilling::class, 'billing_id');
    }
}
