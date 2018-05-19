<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('foreign_currency_id');
            $table->foreign('foreign_currency_id')->references('id')->on('currencies');
            $table->double('exchange_rate');
            $table->float('surcharge_percentage');
            $table->double('purchased_amount_foreign_currency');
            $table->double('paid_amount_usd');
            $table->double('surcharged_amount');
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
        Schema::dropIfExists('quotes');
    }
}
