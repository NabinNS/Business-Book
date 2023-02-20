<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name', 'vat_number', 'phone_number', 'address', 'email_address','opening_balance','date'
    ];

    public function customerledger()
    {
        return $this->hasMany(CustomerLedger::class);
    }

    public function customerRemainingBalance()
    {
        return $this->hasOne(CustomerRemainingBalance::class);
    }
}
