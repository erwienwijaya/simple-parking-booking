<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\BookingController;
use App\Http\Controllers\API\AuthController;

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

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/booking',[BookingController::class, 'index']);
    Route::post('/booking',[BookingController::class, 'store']);
    Route::put('/booking/{car_number}',[BookingController::class, 'update']);
    Route::get('/booking-available',[BookingController::class, 'availableBay']);

    Route::post('/logout',[AuthController::class,'logout']);
});

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);



/*
|----------------------------------------------------------
| Endpoint : Test
|----------------------------------------------------------
|clone endpoint and then add suffix /test/<endpoint_name>
*/
Route::get('/test/booking',[BookingController::class, 'index']);
Route::post('/test/booking',[BookingController::class, 'store']);
Route::put('/test/booking/{car_number}',[BookingController::class, 'update']);
Route::get('/test/booking-available',[BookingController::class, 'availableBay']);

