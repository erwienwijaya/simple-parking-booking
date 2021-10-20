<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\BookingController;

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

Route::get('/booking',[BookingController::class, 'index']);
Route::post('/booking',[BookingController::class, 'store']);
Route::put('/booking/{car_number}',[BookingController::class, 'update']);
Route::get('/booking-available',[BookingController::class, 'availableBay']);
