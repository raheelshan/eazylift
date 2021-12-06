<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('oauth/token', 'Api\AccessTokenController@issueToken');


// Route::post('/user/login', 'AuthController@login');
// Route::post('/user/register', 'AuthController@register');

Route::middleware(['auth:api'])->group(function () {

    // Route::get('/broadcasting/auth',function (Request $request) {
    //     return $request->user();
    // });

    Route::group(['namespace' => 'Api'],function(){
        Route::post('/user/update', 'UserController@update');
        Route::get('/user/get', 'UserController@get');
        Route::get('/user/active', 'UserController@isActive');
        Route::get('/user/pendingamount', 'UserController@pendingAmount');
    	Route::get('/user/unlock', 'UserController@unlock');
        Route::get('/wallet/get', 'WalletController@get');
        Route::get('/trips', 'TripController@history' );
        Route::get('/address/getall', 'AddressController@getAll' );
        Route::get('/vehical/getall', 'VehicalController@getAll' );
        Route::post('/vehical/save', 'VehicalController@save' );
        Route::post('/vehical/delete', 'VehicalController@delete' );
        Route::post('/address/save', 'AddressController@save' );
        Route::post('/address/delete', 'AddressController@delete' );
        Route::post('/booking/search', 'BookingController@search' );
        Route::post('/booking/details', 'BookingController@details' );
        Route::post('/booking/savepath', 'BookingController@savepath' );
        Route::get('/booking/active', 'BookingController@active');
        Route::post('/booking/make', 'BookingController@bookingAttempt' );
        Route::post('/booking/tripreservations', 'BookingController@tripReservations' );
        Route::post('/booking/rideupdate', 'BookingController@rideRequestUpdate' );
        Route::post('/booking/pickupcomplete', 'BookingController@pickupComplete' );
        Route::post('/booking/endride', 'BookingController@endRide' );
        Route::get('/booking/endtrip', 'BookingController@endTrip' );
        Route::post('/booking/cancelreservation', 'BookingController@cancelReservation' );
        Route::post('/booking/captainarrived', 'BookingController@captainArrived' );
        Route::post('/booking/customerrating', 'BookingController@customerRating' );

    });

    /*
    Route::get('/user', 'AuthController@user');
    // Route::post('/user/password/update', 'AuthController@updatePassword');
    // Route::post('/user/forgotpassword', 'AuthController@forgotPassword');
    // Route::post('/user/updatepassword', 'AuthController@passwordUpdate');



    Route::get('/vehicals', 'VehicalController@index');
    */

});




