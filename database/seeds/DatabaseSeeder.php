<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = [ 'purchasable_currencies','currencies'];

    public function run()
    {
        foreach($this->toTruncate as $table) {

            DB::table($table)->delete();

        }

        $this->call(CurrenciesTableSeeder::class);
        $this->call(PurchasableCurrenciesTableSeeder::class);
    }
}
