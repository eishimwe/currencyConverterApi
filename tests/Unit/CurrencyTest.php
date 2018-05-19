<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class CurrencyTest extends TestCase
{
    use DatabaseMigrations;

    protected $currency;


    public function setUp()
    {
        parent::setUp();

        $this->currency = create('App\Currency');
    }

    /** @test */

    function a_currency_has_payment_currencies()
    {

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$this->currency->paymentCurrencies);

    }

    /** @test */

    function a_currency_has_purchasable_currencies()
    {

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$this->currency->purchasableCurrencies);

    }




}
