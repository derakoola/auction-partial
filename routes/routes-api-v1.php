<?php

// API - V1
Route::group([
    'middleware' => ['api.v1', 'jwt.auto.auth.v1'],
    'namespace' => 'Api\V1',
    'prefix' => 'api/v1'
], function () {

    // user
    Route::post('user/register', 'UserController@register');
    Route::post('user/login', 'UserController@login');


    // category
    Route::post('category/index', 'CategoryController@index');


    // auction
    Route::post('auction/index', 'AuctionController@index');
    Route::post('auction/join/{id}', 'AuctionController@join');


    // currency
    Route::post('currency/index', 'CurrencyController@index');


    // locale
    Route::post('locale/index', 'LocaleController@index');
    

    Route::group(
        ['middleware' => ['jwt.auth.v1']],
        function () {

            // socket
            Route::post('socket/join', 'SocketController@join');


            // auction
            Route::post('auction/request-to-bid/{id}', 'AuctionController@requestToBid');


            // lot
            Route::post('lot/store', 'LotController@store');


            // media
            Route::post('media/store', 'MediaController@store');


            Route::group(
                [
                    'middleware' => ['permission']
                ], function () {


                // category
                Route::post('category/store', 'CategoryController@store');


                // live auction
                Route::post('auction/can-bid/{auctionId}', 'AuctionController@canBid');
                Route::post('auction/store', 'AuctionController@store');
                Route::post('auction/add-lot/{id}', 'AuctionController@addLot');
                Route::post('auction/publish/{id}', 'AuctionController@publish');
                Route::post('auction/verify-user-to-bid/{id}', 'AuctionController@verifyUserToBid');
                Route::post('auction/pending-users/{id}', 'AuctionController@pendingUsers');
                Route::post('auction/new-bid/{id}', 'AuctionController@newBid');
                Route::post('auction/pending-bids/{id}', 'AuctionController@pendingBids');
                Route::post('auction/verify-bid/{id}', 'AuctionController@verifyBid');
                Route::post('auction/publish-message/{id}', 'AuctionController@publishMessage');
                Route::post('auction/next-stage/{id}', 'AuctionController@nextStage');

            });

        });

});
