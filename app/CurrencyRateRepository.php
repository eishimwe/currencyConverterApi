<?php
/**
 * Created by PhpStorm.
 * User: Elie.Ishimwe
 * Date: 2018/05/19
 * Time: 3:13 AM
 */

namespace App;


class CurrencyRateRepository implements RepositoryInterface
{
    protected $currencyRate;

    function __construct(CurrencyRate $currencyRate)
    {
        $this->currencyRate = $currencyRate;
    }

    function store($data)
    {
        return $this->currencyRate->create($data);
    }

    public function getRateByCode($from_id,$to_id){

        return $this->currencyRate->where('from_currency_id',$from_id)->where('to_currency_id',$to_id)->first();
    }

}