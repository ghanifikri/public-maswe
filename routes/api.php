<?php

use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Api\LocationController;
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

Route::get('value', [ProductAttributeController::class, 'getValue']);
Route::get('city', [LocationController::class, 'getCity']);
Route::get('district', [LocationController::class, 'getDistrict']);
Route::get('village', [LocationController::class, 'getVillage']);
