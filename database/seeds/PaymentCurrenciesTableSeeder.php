<?php

use Illuminate\Database\Seeder;
use App\PaymentCurrencyRepository;
use App\CurrencyRepository;

class PaymentCurrenciesTableSeeder extends Seeder
{

    protected $paymentCurrency,$currency;

    function __construct(PaymentCurrencyRepository $paymentCurrency,CurrencyRepository $currency)
    {
        $this->paymentCurrency = $paymentCurrency;
        $this->currency        = $currency;
    }

    public function run()
    {
        $currencies = [

            ["currency_id" => $this->currency->getCurrencyByCode('USD')->id]


        ];

        foreach ($currencies as $currency){

            $this->paymentCurrency->store($currency);
        }
    }
}
