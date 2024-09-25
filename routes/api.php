<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\SupplementController;
use App\Http\Controllers\MaintenanceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Country API Routes
Route::apiResource('countries', CountryController::class);

// Trip API Routes
Route::apiResource('trips', TripController::class);

// Accommodation API Routes
Route::apiResource('accommodations', AccommodationController::class);

// Supplement API Routes
Route::apiResource('supplements', SupplementController::class);


Route::get('/clearcache', [MaintenanceController::class, 'clearCache']);
Route::get('/migrate', [MaintenanceController::class, 'migrate']);
