<?php
/**
 * Created by PhpStorm.
 * User: Elie.Ishimwe
 * Date: 2018/05/18
 * Time: 3:22 PM
 */

namespace App;


class PurchasableCurrencyRepository implements RepositoryInterface
{
    protected $currency;

    function __construct(PurchasableCurrency $currency)
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