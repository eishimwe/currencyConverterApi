<?php

use Illuminate\Database\Seeder;
use App\CurrencyRateRepository;
use App\CurrencyRepository;

class CurrencyRatesTableSeeder extends Seeder
{

    protected $currencyRate,$currency;

    function __construct(CurrencyRateRepository $currencyRate,CurrencyRepository $currency)
    {
        $this->currencyRate = $currencyRate;
        $this->currency     = $currency;
    }

    public function run()
    {

        $usdCurrency   = $this->currency->getCurrencyByCode('USD')->id;
        $zarCurrency   = $this->currency->getCurrencyByCode('ZAR')->id;
        $gpCurrency    = $this->currency->getCurrencyByCode('GBP')->id;
        $euCurrency    = $this->currency->getCurrencyByCode('EUR')->id;
        $kesCurrency   = $this->currency->getCurrencyByCode('KES')->id;

        $currencyRates = [

            [
                'from_currency_id'     => $usdCurrency,
                'to_currency_id'       => $zarCurrency,
                'rate'                 => 13.3054,
                'surcharge_percentage' =>  7.5
            ],
            [
                'from_currency_id' => $zarCurrency,
                'to_currency_id'   => $usdCurrency,
                'rate'             => (1 /13.3054)
            ],

            [
                'from_currency_id'     => $usdCurrency,
                'to_currency_id'       => $gpCurrency,
                'rate'                 => 0.651178,
                'surcharge_percentage' =>  5
            ],
            [
                'from_currency_id' => $gpCurrency,
                'to_currency_id'   => $usdCurrency,
                'rate'             => (1 / 0.651178)
            ],
            [
                'from_currency_id' => $usdCurrency,
                'to_currency_id'   => $euCurrency,
                'rate'             => 0.884872,
                'surcharge_percentage' =>  5
            ],
            [
                'from_currency_id' => $euCurrency,
                'to_currency_id'   => $usdCurrency,
                'rate'             => (1 / 0.884872)
            ],
            [
                'from_currency_id' => $usdCurrency,
                'to_currency_id'   => $kesCurrency,
                'rate'             => 103.860,
                'surcharge_percentage' =>  5
            ],
            [
                'from_currency_id' => $kesCurrency,
                'to_currency_id'   => $usdCurrency,
                'rate'             => (1 / 103.860)
            ]

        ];

        foreach ($currencyRates as $currencyRate){

            $this->currencyRate->store($currencyRate);

        }


    }
}
