<?php

use Illuminate\Http\Request;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1','middleware' => []], function()

{

    Route::get('currencies','CurrencyController@index');

    Route::post('quoteUsdForeign','CurrencyController@quoteUsdForeign');

    Route::post('quoteForeignUsd','CurrencyController@quoteForeignUsd');

    Route::post('order','CurrencyController@order');

    Route::get('updateRates','CurrencyController@updateRates');


});
