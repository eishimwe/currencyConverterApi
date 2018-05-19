<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PaymentCurrentTest extends TestCase
{

    use DatabaseMigrations;

    protected $paymentCurrency;


    public function setUp()
    {
        parent::setUp();

        $this->paymentCurrency = create('App\PaymentCurrency');
    }


}
