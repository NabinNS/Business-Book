<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRemainingBalance extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'date','amount','customer_id'
    ];
    protected $primarykey = 'cusbalance_id';

    public function CustomerDetail(){
        return $this->belongsTo(CustomerDetail::class);
    }
}
