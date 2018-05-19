<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = [
                                'payment_currencies',
                                'purchasable_currencies',
                                'currency_rates',
                                'currencies'];

    public function run()
    {
        foreach($this->toTruncate as $table) {

            DB::table($table)->delete();

        }

        $this->call(CurrenciesTableSeeder::class);
        $this->call(PurchasableCurrenciesTableSeeder::class);
        $this->call(PaymentCurrenciesTableSeeder::class);
        $this->call(CurrencyRatesTableSeeder::class);
    }
}
