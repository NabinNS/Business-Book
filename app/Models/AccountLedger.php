<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountLedger extends Model
{
    use HasFactory;
    protected $fillable = [
        'date','receipt_no','particulars','debit','credit','company_details_id'
    ];
    public function companyInformation(){
        return $this->belongsTo(CompanyInformation::class);
    }
}
