<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountRemainingBalance extends Model
{
    use HasFactory;
    protected $fillable = [
        'date','amount','company_details_id'
    ];
    protected $primaryKey = 'accbalance_id';
    public function companyDetails(){
        return $this->belongsTo(CompanyDetails::class);
    }   
}
