<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountLedger extends Model
{
    use HasFactory;
    protected $primaryKey = 'acc_id';
    protected $fillable = [
        'date','receipt_no','particulars','debit','credit','company_details_id'
    ];
   
    public function companyDetails(){
        return $this->belongsTo(CompanyDetails::class);
    }
}
