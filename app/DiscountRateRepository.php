<?php
/**
 * Created by PhpStorm.
 * User: Elie.Ishimwe
 * Date: 2018/05/20
 * Time: 8:10 AM
 */

namespace App;


class DiscountRateRepository implements RepositoryInterface
{
    protected $discountRate;

    function __construct(DiscountRate $discountRate)
    {
        $this->discountRate = $discountRate;

    }

    function store($data)
    {
        return $this->discountRate->create($data);
    }

    function find($id){

        return $this->discountRate->where('currency_id',$id)->first();
    }

}