<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;
    protected $guarded = [
    ];

    public function billing()
    {
        return $this->belongsTo(CustomerBilling::class, 'billing_id');
    }
}
