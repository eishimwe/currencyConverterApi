<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentCurrency extends Model
{
    protected $guarded = [];

    protected  $with    = ['currency'];

    public function currency(){

        return $this->belongsTo(Currency::class);

    }


}
