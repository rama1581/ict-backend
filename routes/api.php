<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\RequestForm;
use Illuminate\Validation\Rule;
use App\Models\ServiceStatus;

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
        // 👇 2. Modifikasi aturan validasi email
        'email' => [
            'required',
            'email',
            'max:255',
            Rule::unique('request_forms')->where(function ($query) {
                // Hanya tolak jika email sudah ada DAN statusnya 'pending'
                return $query->where('status', 'pending');
            }),
        ],
        'category' => 'required|string',
        'message' => 'required|string',
    ], [
        // 3. Tambahkan pesan error kustom (opsional)
        'email.unique' => 'Anda sudah memiliki pengajuan yang sedang diproses. Mohon tunggu.'
    ]);

    RequestForm::create($validated);
    return response()->json(['message' => 'Request submitted successfully'], 201);
});

Route::get('/service-status', function () {
    return response()->json(ServiceStatus::all());
});

// Rute untuk testing koneksi dasar
Route::get('/test', function () {
    return response()->json([
        'message' => 'Halo dari Bandung!'
    ]);
});