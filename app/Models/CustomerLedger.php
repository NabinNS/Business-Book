<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerLedger extends Model
{
    use HasFactory;

    protected $fillable = [
        'date','receipt_no','particulars','debit','credit','customer_id'
    ];
    protected $primaryKey = 'customerledger_id';
    public function CustomerDetail(){
        return $this->belongsTo(CustomerDetail::class);
    }
}
