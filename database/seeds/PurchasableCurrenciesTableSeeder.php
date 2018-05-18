<?php

use Illuminate\Database\Seeder;
use App\PurchasableCurrencyRepository;
use App\CurrencyRepository;

class PurchasableCurrenciesTableSeeder extends Seeder
{
    protected $purchasableCurrency,$currency;

    function __construct(PurchasableCurrencyRepository $purchasableCurrency,CurrencyRepository $currency)
    {
        $this->purchasableCurrency = $purchasableCurrency;
        $this->currency = $currency;
    }


    public function run()
    {
        $currencies = [

            ["currency_id" => $this->currency->getCurrencyByCode('ZAR')->id],
            ["currency_id" => $this->currency->getCurrencyByCode('GBP')->id],
            ["currency_id" => $this->currency->getCurrencyByCode('EUR')->id],
            ["currency_id" => $this->currency->getCurrencyByCode('KES')->id],

        ];

        foreach ($currencies as $currency){

            $this->purchasableCurrency->store($currency);
        }

    }
}
