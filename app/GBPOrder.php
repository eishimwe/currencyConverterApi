<?php
/**
 * Created by PhpStorm.
 * User: Elie.Ishimwe
 * Date: 2018/05/20
 * Time: 7:15 AM
 */

namespace App;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendOrderMailer;
use Illuminate\Foundation\Bus\DispatchesJobs;

class GBPOrder implements OrderInterface
{

     use DispatchesJobs;

    protected $currencyOrder,$comm;

    function __construct(OrderRepository $currencyOrder)
    {
        $this->currencyOrder = $currencyOrder;

        $this->comm = new CommRepository(new Comm);


    }


    function placeOrder($data)
    {

        $params = [

            'quote_id' => $data->id


        ];

        $order = $this->currencyOrder->store($params);
        $comm  = $this->comm->findByName('Order Processed');

        $this->dispatch((new SendOrderMailer($comm->to,$data))->delay(3));

        return $order;

    }

}