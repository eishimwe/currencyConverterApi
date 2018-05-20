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
    protected $currency,$paymentCurrency,$purchasableCurrency,$currencyRate,$currencyQuote,$currencyOrder,$comm;

    function __construct(Currency $currency)
    {
        $this->currency            = $currency;
        $this->paymentCurrency     = new PaymentCurrencyRepository(new PaymentCurrency);
        $this->purchasableCurrency = new PurchasableCurrencyRepository(new PurchasableCurrency);
        $this->currencyRate        = new CurrencyRateRepository(new CurrencyRate);
        $this->currencyQuote       = new QuoteRepository(new Quote);
        $this->currencyOrder       = new OrderRepository(new Order);

    }

    public function store($data){

        return $this->currency->create($data);

    }

    function find($id){

        return $this->currency->find($id);
    }

    public function getCurrencyByCode($code){

        return $this->currency->where('code',$code)->first();
    }

    public function getCurrencies(){

        $paymentCurrencies     = $this->getPaymentCurrencies();
        $purchasableCurrencies = $this->getPurchasableCurrencies();

        $response = [

            'paymentCurrencies'     => $paymentCurrencies,
            'purchasableCurrencies' => $purchasableCurrencies

        ];

        return $response;

    }

    protected function getPaymentCurrencies(){

        return $this->paymentCurrency->get()->toArray();
    }

    protected function getPurchasableCurrencies(){

        return $this->purchasableCurrency->get()->toArray();
    }

    public function quoteUsdForeign($data){


        $params = [

            'from' => $this->getCurrencyByCode($data['from'])->id,
            'to'   => $this->getCurrencyByCode($data['to'])->id,
            'amount'   => $data['amount'],

        ];

        return $this->calculateQuoteUsdForeign($params);

    }

    protected function calculateQuoteUsdForeign($params){

        $currencyRateObj = $this->currencyRate->getRateByCode($params['from'],$params['to']);
        $subTotal        = $currencyRateObj->rate * $params['amount'];
        $surCharge       = ($subTotal * $currencyRateObj->surcharge_percentage)/100;
        $total           = $subTotal + $surCharge;

        $quote['foreign_currency_id']               = $currencyRateObj->to_currency_id;
        $quote['exchange_rate']                     = $currencyRateObj->rate;
        $quote['surcharge_percentage']              = $currencyRateObj->surcharge_percentage;
        $quote['purchased_amount_foreign_currency'] = $total;
        $quote['paid_amount_usd']                   = $params['amount'];
        $quote['surcharged_amount']                 = $surCharge;

        $quote = $this->saveQuote($quote);

        return ['amount' => $total,'id' => $quote->id] ;
    }

    protected function saveQuote($data){

       return $this->currencyQuote->store($data);
    }

    public function quoteForeignUsd($data){


        $params = [

            'from' => $this->getCurrencyByCode($data['from'])->id,
            'to'   => $this->getCurrencyByCode($data['to'])->id,
            'amount'   => $data['amount'],

        ];

        return $this->calculateQuoteForeignUsd($params);

    }


    protected function calculateQuoteForeignUsd($params){

        $currencyRateObj = $this->currencyRate->getRateByCode($params['to'],$params['from']);
        $surCharge       = ($params['amount'] * $currencyRateObj->surcharge_percentage)/100;
        $total           = ($params['amount'] - $surCharge) / $currencyRateObj->rate;

        $quote['foreign_currency_id']               = $currencyRateObj->to_currency_id;
        $quote['exchange_rate']                     = $currencyRateObj->rate;
        $quote['surcharge_percentage']              = $currencyRateObj->surcharge_percentage;
        $quote['purchased_amount_foreign_currency'] = $params['amount'];
        $quote['paid_amount_usd']                   = $total;
        $quote['surcharged_amount']                 = $surCharge;

        $quote = $this->saveQuote($quote);

        return ['amount' => $total,'id' => $quote->id] ;
    }

    public function order($data){


        $quote                = $this->currencyQuote->find($data['quote_id']);

        $currency             = $this->currency->find($quote->foreign_currency_id);

        $orderImplementation  = 'App\\'.$currency->code.'Order';

        $order                = (new $orderImplementation($this->currencyOrder))->placeOrder($quote);

        return $order;

    }

    public function updateCurrency($rates){

        $currentRates = $this->currencyRate->get();

        foreach ($currentRates as $currencyRate){

            if($currencyRate->currency->code == 'GBP'){

                $this->currencyRate->update($currencyRate->id,['rate' => $rates->USDGBP]);
            }
            if($currencyRate->currency->code == 'ZAR'){

                $this->currencyRate->update($currencyRate->id,['rate' => $rates->USDZAR]);
            }

            if($currencyRate->currency->code == 'EUR'){

                $this->currencyRate->update($currencyRate->id,['rate' => $rates->USDEUR]);
            }

            if($currencyRate->currency->code == 'KES'){

                $this->currencyRate->update($currencyRate->id,['rate' => $rates->USDKES]);
            }
        }


    }



}