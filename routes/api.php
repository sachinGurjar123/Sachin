<?php

use App\Http\Controllers\Api\V1\Customer\TestController as CustomerTestController;
use App\Http\Controllers\Api\V1\BusOperator\TestController as BusOperatorTestController;
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

Route::get('/v1/test', 'Api\V1\TestController@test');



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['optimizeImages'], 'prefix' => '/v1', 'namespace' => 'Api\V1'], function () {
    /* Amenity Apis */
    Route::get('/get-amenities', 'AmenityController@index');

    /* Bus Type Apis */
    Route::get('/get-bus-types', 'BusTypeController@index');

    /* City Apis */
    Route::get('/get-cities', 'CityController@index');
    Route::get('/get-top-cities', 'CityController@getTopCity');
    Route::get('/get-city-by-name/{city_name}', 'CityController@getCityByName');
});

Route::group(['middleware' => ['optimizeImages'], 'prefix' => '/v1/BusOperator', 'namespace' => 'Api\V1\BusOperator'], function () {
    Route::get('/test', [BusOperatorTestController::class, 'test']);
});


Route::group(['middleware' => ['optimizeImages'], 'prefix' => '/v1/customer', 'namespace' => 'Api\V1\Customer'], function () {
    Route::get('/test', [CustomerTestController::class, 'test']);

    // -------- Register And Login API ----------
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'authMobileCheck');
        Route::post('login-otp', 'authWithOtp');
    });

    Route::controller(CFaqController::class)->group(function () {
        Route::get('faqs', 'index');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('get-profile', 'edit');
        Route::post('update', 'update');
        Route::post('update-image', 'updateImage');
    });



    /* Content Page Url's */
    Route::get('/get-content-page-url', 'CMoreInfoController@getContentPageUrl');

    /*Support Manager */
    Route::post('/store-support-msg', 'CMoreInfoController@storeSupportMsg');

    // -------- Register And Login API ----------
    Route::group(['middleware' => ['jwt.auth']], function () {
        /* Profile Controller */
        Route::controller(AuthController::class)->group(function () {
            Route::post('logout', 'logout');
        });
    });
});
