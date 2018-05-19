<?php
/**
 * Created by PhpStorm.
 * User: Elie.Ishimwe
 * Date: 2018/05/19
 * Time: 7:02 PM
 */

namespace App;


class OrderRepository implements RepositoryInterface
{

    protected $order;

    function __construct(Order $order)
    {
        $this->order   = $order;
    }


    function store($data)
    {
        return $this->order->create($data);
    }

}