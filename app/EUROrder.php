<?php
/**
 * Created by PhpStorm.
 * User: Elie.Ishimwe
 * Date: 2018/05/20
 * Time: 7:40 AM
 */

namespace App;


class EUROrder implements OrderInterface
{

    protected $currencyOrder,$currencyRate,$orderDiscount;

    function __construct(OrderRepository $currencyOrder)
    {
        $this->currencyOrder = $currencyOrder;
        $this->currencyRate  = new CurrencyRateRepository(new CurrencyRate);
        $this->orderDiscount = new OrderDiscountRepository(new OrderDiscount);
        $this->discountRate  = new DiscountRateRepository(new DiscountRate);



    }


    function placeOrder($quote)
    {

        $orderParams = [

            'quote_id' => $quote->id


        ];

        $order          = $this->currencyOrder->store($orderParams);
        $discountRate   = $this->discountRate->find($quote->foreign_currency_id)->rate;
        $discount       = $quote->purchased_amount_foreign_currency * $discountRate;


        $discountParams = [

            'order_id'             => $order->id,
            'discount_amount'      => $discount,
            'discount_percentage'  => $discountRate

        ];


        $this->orderDiscount->store($discountParams);

        return $order;


    }

}