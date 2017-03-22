<?php

use App\Helpers\Api\V1\ApiHelper;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Web\Front\V1'], function () {

    Route::group([
        'middleware' => ['localizationRedirect']
    ], function () {
        Route::get('/', 'HomeController@index');
    });

    foreach (ApiHelper::getLocales(false, true) as $locale) {
        Route::group([
            'prefix' => $locale,
            'middleware' => ['setLocale']
        ], function () {

            // auction
            Route::get('/', 'HomeController@index');
            Route::get('/home', 'HomeController@home');
            Route::get('auctions', 'AuctionController@index');
            Route::get('auction/{id}', 'AuctionController@show');
            Route::get('auction/manage/{id}', 'AuctionController@manage');


            // currency
            Route::get('currency/change/{currency}', 'CurrencyController@change');

            // account
            Route::get('account', 'AccountController@show');

            //contact
            Route::get('contact', 'ContactController@index');

            //about
            Route::get('about', 'AboutController@index');

        });
    }
});


