<?php

Route::group([
    'prefix' => 'admin'
], function () {

    // login
    Route::get('login', 'Auth\LoginController@showLoginForm');
    Route::post('login', 'Auth\LoginController@login');

    // auth
    Route::get('logout', 'Auth\LoginController@logout');

    Route::group([
        'middleware' => ['admin'],
    ], function () {
        Route::get('/', 'AdminHomeController@index');

        //auctions
        Route::get('/auctions/index', 'AdminAuctionController@index');
        Route::get('/auctions/hot', 'AdminAuctionController@hotAuctions');
        Route::get('/auctions/add', 'AdminAuctionController@add');
        Route::get('/auctions/bidded/{auction_id}', 'AdminAuctionController@UsersBidded');
        Route::post('/auctions/add', 'AdminAuctionController@save');
        Route::post('/auctions/add/lot', 'AdminAuctionController@addLot');
        Route::get('/auctions/edit/{id}', 'AdminAuctionController@edit');
        Route::post('/auctions/edit', 'AdminAuctionController@update');
        Route::get('/auctions/lots/{id}', 'AdminAuctionController@lots');
        Route::get('/auctions/bidrules/{id}', 'AdminAuctionController@bidRules');
        Route::get('/auctions/canbid/{id}', 'AdminAuctionController@canBidUsers');
        Route::get('/auctions/admin/add/{id}', 'AdminAuctionController@NewAdmin');
        Route::post('/auctions/admin/add/{id}', 'AdminAuctionController@saveNewAdmin');
        Route::get('/auctions/currentlot/{id}', 'AdminAuctionController@currentLot');
        Route::get('/auctions/publish/{auction_id}', 'AdminAuctionController@publish');
        Route::get('/auctions/sold/{id}', 'AdminAuctionController@soldLots');

        //lots
        Route::get('/lots/index',array('as' => 'lots.index', 'uses' => 'AdminLotController@index'));
        Route::get('/lots/sold/index', 'AdminLotController@soldLots');
        Route::get('/lots/add', 'AdminLotController@add');
        Route::post('/lots/add', 'AdminLotController@save');
        Route::get('/lots/delete/{id}', 'AdminLotController@delete');
        Route::post('/lots/bids', 'AdminLotController@bids');
        Route::post('/lots/bidders', 'AdminLotController@bidders');


        //categories
        Route::get('/categories/index', 'AdminCategoryController@index');
        Route::get('/categories/add', 'AdminCategoryController@add');
        Route::post('/categories/add', 'AdminCategoryController@save');
        Route::get('/category/delete/{id}', 'AdminCategoryController@delete');

        //users
        Route::get('/users/index', 'AdminUserController@index');
        Route::get('/users/bidded/{user_id}', 'AdminUserController@bids');
        Route::get('/users/show/{user_id}', 'AdminUserController@show');
        Route::get('/users/autocomplete', 'AdminUserController@autocomplete');
        Route::get('/users/permissions/index', 'AdminUserController@permissions');
        Route::get('/users/permissions/{user_id}', 'AdminUserController@userPermissions');
        Route::get('/users/add', 'AdminUserController@add');
        Route::post('/users/add', 'AdminUserController@save');


        //countries
        Route::get('/countries/all', 'AdminCountryController@index');
    });
});
