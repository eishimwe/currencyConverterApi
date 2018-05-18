<?php
/**
 * Created by PhpStorm.
 * User: Elie.Ishimwe
 * Date: 2018/05/18
 * Time: 3:01 PM
 */

namespace App;


class CurrencyRepository
{
    protected $currency;

    function __construct(Currency $currency)
    {
        $this->currency = $currency;
    }

    public function store($data){

        return $this->currency->create($data);

    }

}