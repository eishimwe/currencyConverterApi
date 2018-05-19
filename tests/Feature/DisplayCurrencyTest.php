<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DisplayCurrencyTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */

    public function guest_can_view_payment_currencies()
    {

        $this->withoutExceptionHandling();

        $usdCurrency = create('App\Currency',['name' => 'US Dollars (USD)','code' => 'USD']);
        $usdPaymentCurrency = create('App\PaymentCurrency',['currency_id' => $usdCurrency->id]);

        $zarCurrency = create('App\Currency',['name' => 'South African Rands (ZAR)','code' => 'ZAR']);
        $zarPurchasableCurrency = create('App\PurchasableCurrency',['currency_id' => $zarCurrency->id]);

        $britishCurrency = create('App\Currency',['name' => 'British Pound (GBP)','code' => 'GBP)']);
        $britishPurchasableCurrency = create('App\PurchasableCurrency',['currency_id' => $britishCurrency->id]);

        $euroCurrency = create('App\Currency',['name' => 'Euro (EUR)','code' => 'EUR']);
        $euroPurchasableCurrency = create('App\PurchasableCurrency',['currency_id' => $euroCurrency->id]);


        $kenyaCurrency = create('App\Currency',['name' => 'Kenyan Shilling (KES)','code' => 'KES']);
        $kenyaPurchasableCurrency = create('App\PurchasableCurrency',['currency_id' => $kenyaCurrency->id]);

        $this->json('GET','api/v1/currencies')->assertStatus(200)
             ->assertJsonStructure(['success','data']);





    }
}
