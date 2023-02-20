<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockRemainingBalance extends Model
{
    use HasFactory;
    protected $fillable = [
        'date','quantity','stock_id'
    ];
    protected $primarykey = 'stockbalance_id';

    public function StockDetail(){
        return $this->belongsTo(StockDetail::class);
    }
}
