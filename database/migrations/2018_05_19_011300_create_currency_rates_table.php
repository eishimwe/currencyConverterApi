<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrencyRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('from_currency_id');
            $table->foreign('from_currency_id')->references('id')->on('currencies');
            $table->unsignedInteger('to_currency_id');
            $table->foreign('to_currency_id')->references('id')->on('currencies');
            $table->double('rate');
            $table->float('surcharge_percentage')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currency_rates');
    }
}
