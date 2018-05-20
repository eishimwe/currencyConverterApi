<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $guarded = [];

    protected $with    = ['currency'];

    public function currency(){

        return $this->belongsTo(Currency::class,'foreign_currency_id');
    }
}
