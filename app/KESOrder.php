<?php
/**
 * Created by PhpStorm.
 * User: Elie.Ishimwe
 * Date: 2018/05/20
 * Time: 9:01 AM
 */

namespace App;


class KESOrder implements OrderInterface
{

    protected $currencyOrder;

    function __construct(OrderRepository $currencyOrder)
    {
        $this->currencyOrder = $currencyOrder;


    }

    function placeOrder($quote)
    {
        $orderParams = [

            'quote_id' => $quote->id


        ];

        return $this->currencyOrder->store($orderParams);
    }

}