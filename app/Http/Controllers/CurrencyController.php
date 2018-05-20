<?php

namespace App\Http\Controllers;

use App\CurrencyRepository;
use App\Http\Requests\CurrencyQuoteRequest;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

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

    public function quoteUsdForeign(CurrencyQuoteRequest $request){

        $quote = $this->currency->quoteUsdForeign($request['data']);

        return response(['success' => 'true','data' => $quote ],200);
    }

    public function quoteForeignUsd(Request $request){

        $quote = $this->currency->quoteForeignUsd($request['data']);

        return response(['success' => 'true','data' => $quote ],200);
    }

    public function order(Request $request){

        $order = $this->currency->order($request['data']);

        return response(['success' => 'true','data' => $order ],200);
    }

    public function updateRates(){

        $rates = Cache::remember('rates', 1, function() {

            return $this->getApiRates();
        });

        $this->currency->updateCurrency($rates);


    }

    protected function getApiRates(){


        $client = new Client();

        $apiEndPoint = env('GUZZLE_API_URL').'?access_key='.env('GUZZLE_API_KEY');
        $params      = "&currencies=USD,GBP,EUR,ZAR,KES&format=1";
        $res         = $client->request('GET', $apiEndPoint.$params);

        if($res->getStatusCode() == '200'){

            $response = json_decode($res->getBody());
            $rates    = $response->quotes;

            return $rates;

        }

    }


}
