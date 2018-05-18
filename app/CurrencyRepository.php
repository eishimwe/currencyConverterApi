<?php
/**
 * Created by PhpStorm.
 * User: Elie.Ishimwe
 * Date: 2018/05/18
 * Time: 3:01 PM
 */

namespace App;


class CurrencyRepository implements RepositoryInterface
{
    protected $currency;

    function __construct(Currency $currency)
    {
        $this->currency = $currency;
    }

    public function store($data){

        return $this->currency->create($data);

    }

    public function getCurrencyByCode($code){

        return $this->currency->where('code',$code)->first();
    }

}