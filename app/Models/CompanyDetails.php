<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name', 'vat_number', 'phone_number', 'address', 'email_address','opening_balance','date'
    ];
    public function accountLedger()
    {
        return $this->hasMany(AccountLedger::class);
    }
    public function accountsSummary()
    {
        return $this->hasOne(AccountsSummary::class);
    }
    public function accountRemainingBalance()
    {
        return $this->hasOne(AccountRemainingBalance::class);
    }
}
