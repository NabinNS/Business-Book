<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockLedger extends Model
{
    use HasFactory;
    protected $fillable = [
        'date','receipt_no','particulars','quantity','rate','issued_quantity'
    ];
    protected $primaryKey = 'stockledger_id';
    public function StockDetail(){
        return $this->belongsTo(StockDetail::class);
    }
}
