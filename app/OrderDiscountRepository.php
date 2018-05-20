<?php
/**
 * Created by PhpStorm.
 * User: Elie.Ishimwe
 * Date: 2018/05/20
 * Time: 7:07 AM
 */

namespace App;


class OrderDiscountRepository implements RepositoryInterface
{

    protected $orderDiscount;

    function __construct(OrderDiscount $orderDiscount)
    {
        $this->orderDiscount = $orderDiscount;
    }

    function store($data)
    {
        $this->orderDiscount->create($data);
    }

}