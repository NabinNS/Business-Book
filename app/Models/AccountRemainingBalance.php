<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountRemainingBalance extends Model
{
    use HasFactory;
    protected $fillable = [
        'date','company_name','amount','company_details_id'
    ];
    public function companyInformation(){
        return $this->belongsTo(CompanyInformation::class);
    }   
}
