<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Models\CompanyEmployee;
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

Route::group(['auth:api'], function ($router) {

    // Route::post('logout', 'AuthController@logout');
    // Route::post('refresh', 'AuthController@refresh');
    Route::get('me', [AuthController::class, 'me']);
    Route::group(['middleware' => ['role:admin'], 'prefix' => 'admin'], function () {
        Route::apiResource('company', CompanyController::class);
        Route::apiResource('employee', EmployeeController::class);

    });
});

Route::post('login', [AuthController::class, 'login']);
