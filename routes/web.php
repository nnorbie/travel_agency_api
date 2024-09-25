<?php

use App\Http\Controllers\ImageUploadController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    try {
        $response = Http::withoutVerifying()->get('http://remix-tour.free.nf/travel_agency_api/api/countries');

        if ($response->successful()) {
            return $response;
        } else {
            return response()->json([
                'error' => 'Failed to fetch data',
                'status' => $response->status()
            ], $response->status());
        }
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'An error occurred',
            'message' => $e->getMessage()
        ], 500);
    }
});

// Images
Route::get('/images', [ImageUploadController::class, 'index'])->name('images.index');

// Image upload route
Route::get('/upload', [ImageUploadController::class, 'showForm'])->name('show.upload.form');
Route::post('/upload', [ImageUploadController::class, 'upload'])->name('upload.image');
