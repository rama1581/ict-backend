<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Rute-rute ini secara otomatis diberi prefix /api oleh Laravel.
|
*/

// Rute untuk otentikasi (jika menggunakan Sanctum)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// --- Rute untuk Resource "Post" ---
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

// --- Rute untuk Resource "News" ---
Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/{news:slug}', [NewsController::class, 'show']);

// --- Rute untuk Konfigurasi Aplikasi ---

// Rute untuk mengambil Google Maps API Key secara aman
Route::get('/config/maps', function () {
    return response()->json([
        'Maps_api_key' => config('app.Maps_api_key'),
    ]);
});

Route::get('/location/school', function () {
    $location = \App\Models\Location::all()->first();
    
    return response()->json($location);
});


// Rute untuk testing koneksi dasar
Route::get('/test', function () {
    return response()->json([
        'message' => 'Halo dari Bandung!'
    ]);
});