<?php

use App\Http\Controllers\Api\V1\Customer\TestController as CustomerTestController;
use App\Http\Controllers\Api\V1\Manager\TestController as ManagerTestController;
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

Route::group(['middleware' => ['optimizeImages'], 'prefix' => '/v1/manager', 'namespace' => 'Api\V1\Manager'], function () {
    Route::get('/test', [ManagerTestController::class, 'test']);
});

Route::group(['middleware' => ['optimizeImages'], 'prefix' => '/v1/customer', 'namespace' => 'Api\V1\Customer'], function () {
    Route::get('/test', [CustomerTestController::class, 'test']);

    // -------- Register And Login API ----------
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'authMobileCheck');
        Route::post('login-otp', 'authWithOtp');
    });

    // -------- Register And Login API ----------
    Route::group(['middleware' => ['jwt.auth']], function () {
        /* Profile Controller */
        Route::controller(AuthController::class)->group(function () {
            Route::post('logout', 'logout');
        });
    });
});
