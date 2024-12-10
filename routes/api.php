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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/barangs', App\Http\Controllers\Api\BarangController::class);
Route::apiResource('/brg_keluars', App\Http\Controllers\Api\Brg_keluarController::class);
Route::apiResource('/brg_masuks', App\Http\Controllers\Api\Brg_masukController::class);
Route::apiResource('/customers', App\Http\Controllers\Api\CustomerController::class);
Route::apiResource('/users', App\Http\Controllers\Api\UserController::class);


