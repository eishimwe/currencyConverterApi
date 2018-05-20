<?php

use Illuminate\Database\Seeder;
use App\DiscountRateRepository;
use App\CurrencyRepository;
use App\Currency;

class DiscountRateTableSeeder extends Seeder
{

    protected $discountRate,$currency;

    function __construct(DiscountRateRepository $discountRate)
    {
        $this->discountRate = $discountRate;
        $this->currency     = new CurrencyRepository(new Currency);

    }


    public function run()
    {

        $discountRates = [

            [ 'currency_id' => $this->currency->getCurrencyByCode('EUR')->id,'rate' => 2]

        ];

        foreach ($discountRates as $discountRate){

            $this->discountRate->store($discountRate);
        }
    }
}
