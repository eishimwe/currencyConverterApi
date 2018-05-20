<?php
/**
 * Created by PhpStorm.
 * User: Elie.Ishimwe
 * Date: 2018/05/18
 * Time: 4:11 PM
 */

namespace App;


class PaymentCurrencyRepository implements RepositoryInterface
{


    protected $currency;

    function __construct(PaymentCurrency $currency)
    {
        $this->currency = $currency;

    }


    function store($data)
    {
        return $this->currency->create($data);
    }

    function get(){

        return $this->currency->get();
    }

}