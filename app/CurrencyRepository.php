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
    protected $currency,$paymentCurrency,$purchasableCurrency,$currencyRate,$currencyQuote,$currencyOrder;

    function __construct(Currency $currency,PaymentCurrency $paymentCurrency,
                         PurchasableCurrency $purchasableCurrency,
                         CurrencyRateRepository $currencyRate,
                         QuoteRepository $currencyQuote,
                         OrderRepository $currencyOrder)
    {
        $this->currency            = $currency;
        $this->paymentCurrency     = $paymentCurrency;
        $this->purchasableCurrency = $purchasableCurrency;
        $this->currencyRate        = $currencyRate;
        $this->currencyQuote       = $currencyQuote;
        $this->currencyOrder       = $currencyOrder;
    }

    public function store($data){

        return $this->currency->create($data);

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

    public function quote($data){


        $params = [

            'from' => $this->getCurrencyByCode($data['from'])->id,
            'to'   => $this->getCurrencyByCode($data['to'])->id,
            'amount'   => $data['amount'],

        ];

        return $this->calculateQuote($params);

    }

    protected function calculateQuote($params){

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

    public function order($data){

        return $this->currencyOrder->store($data);

    }

}