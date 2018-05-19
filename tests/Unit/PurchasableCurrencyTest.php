<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PurchasableCurrencyTest extends TestCase
{
    use DatabaseMigrations;

    protected $purchasableCurrency;


    public function setUp()
    {
        parent::setUp();

        $this->purchasableCurrency = create('App\PurchasableCurrency');
    }



}
