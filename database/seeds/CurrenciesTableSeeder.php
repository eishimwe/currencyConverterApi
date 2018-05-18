<?php

use Illuminate\Database\Seeder;
use App\CurrencyRepository;

class CurrenciesTableSeeder extends Seeder
{

    protected $currency;

    function __construct(CurrencyRepository $currency)
    {
        $this->currency = $currency;
    }

    public function run()
    {
        $currencies = [

            ["name" => 'USD Dollars','code' => "USD"],
            ["name" => 'South African Rands (ZAR)','code' => "ZAR"],
            ["name" => 'British Pound (GBP)','code' => "GBP"],
            ["name" => 'Euro (EUR)','code' => "EUR"],
            ["name" => 'Kenyan Shilling (KES)','code' => "KES"],

        ];

        foreach ($currencies as $currency){

            $this->currency->store($currency);

        }
    }
}
