<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'stock_name','limit','purchase_price','sales_price','opening_balance','date'
    ];

    public function stockledger()
    {
        return $this->hasMany(StockLedger::class);
    }
    public function stockRemainingBalance()
    {
        return $this->hasOne(StockRemainingBalance::class);
    }
}
