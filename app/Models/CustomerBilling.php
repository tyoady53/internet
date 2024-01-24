<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerBilling extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function consumption()
    {
        return $this->hasMany(CustomerConsumption::class, 'consumption_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
