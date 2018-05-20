<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{

    protected $guarded = [];

    protected $with    = ['currency'];

    public function currency(){

        return $this->belongsTo(Currency::class,'to_currency_id');
    }

}
