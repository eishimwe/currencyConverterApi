<?php

namespace App\Http\Controllers;

use App\CurrencyRepository;
use App\Http\Requests\CurrencyQuoteRequest;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{

    protected $currency;

    function __construct(CurrencyRepository $currency)
    {
        $this->currency        = $currency;

    }

    public function index(){

        $currencies = $this->currency->getCurrencies();

        return response(['success' => 'true','data' => $currencies ],200);


    }

    public function quote(CurrencyQuoteRequest $request){

        $quote = $this->currency->quote($request['data']);

        return response(['success' => 'true','data' => $quote ],200);
    }

    public function order(Request $request){

        $order = $this->currency->order($request['data']);

        return response(['success' => 'true','data' => $order ],200);
    }
}
