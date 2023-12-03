<?php

use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\TransactionController;
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

//Route::get('provinces', [LocationController::class, 'provinces'])->name('api-provinces');
//Route::get('cities/{provinces_id}', [LocationController::class, 'cities'])->name('api-cities');
//Route::get('districts/{cities_id}', [LocationController::class, 'districts'])->name('api-districts');
//Route::get('subdistricts/{districts_id}', [LocationController::class, 'subdistricts'])->name('api-subdistricts');
Route::get('/location/{type}/{id}', LocationController::class)->name('api-location');
Route::get('/transaction/{id}', TransactionController::class)->name('api-transaction');
