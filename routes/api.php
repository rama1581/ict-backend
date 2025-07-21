<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\RequestForm;

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

Route::get('/news/latest', function () {
    // Hapus with('author') karena tabel news tidak punya relasi itu
    $latestNews = \App\Models\News::latest()->first();
    
    return response()->json($latestNews);
});

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



Route::post('/requests', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'category' => 'required|string',
        'message' => 'required|string',
    ]);

    RequestForm::create($validated);

    return response()->json(['message' => 'Request submitted successfully'], 201);
}); 

// Rute untuk testing koneksi dasar
Route::get('/test', function () {
    return response()->json([
        'message' => 'Halo dari Bandung!'
    ]);
});