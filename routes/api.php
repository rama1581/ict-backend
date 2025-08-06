<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\ServiceStatusLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\RequestForm;
use Illuminate\Validation\Rule;
use App\Models\ServiceStatus;
use Illuminate\Support\Str;
use App\Models\TicketProgress;
use App\Models\Message;
use App\Http\Controllers\Api\HomePageController;
use App\Http\Controllers\Api\GuideController;
use App\Http\Controllers\Api\ServicePageController;

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
Route::get('/news/latest', [NewsController::class, 'latest']);
Route::get('/news/popular', [NewsController::class, 'popular']);
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



Route::post('/requests', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => [
            'required',
            'email',
            'max:255',
            Rule::unique('request_forms')->where(function ($query) {
                return $query->where('status', 'pending');
            }),
        ],
        'category' => 'required|string',
        'message' => 'required|string',
    ], [
        'email.unique' => 'Anda sudah memiliki pengajuan yang sedang diproses. Mohon tunggu.'
    ]);

    // ✅ Generate ticket_code dan status
    $validated['ticket_code'] = strtoupper(Str::random(8));
    $validated['status'] = 'pending';

    // ✅ Simpan ke database
    $form = RequestForm::create($validated);

    // ✅ Kirim response ke frontend
    return response()->json([
        'message' => 'Request submitted successfully',
        'ticket_code' => $form->ticket_code,
        'status' => $form->status,
    ], 201);
});

Route::get('/requests/status/{ticket_code}', function ($ticket_code) {
    $request = RequestForm::where('ticket_code', $ticket_code)
        ->with(['progresses' => function ($q) {
            $q->orderBy('created_at', 'asc');
        }])
        ->first();

    if (! $request) {
        return response()->json(['message' => 'Tiket tidak ditemukan.'], 404);
    }

    return response()->json([
        'ticket_code' => $request->ticket_code,
        'name'        => $request->name,
        'category'    => $request->category,
        'message'     => $request->message,
        'status'      => $request->status,
        'created_at'  => $request->created_at->toDateTimeString(),
        'progresses'  => $request->progresses->map(function ($p) {
            return [
                'id'         => $p->id,
                'status'     => $p->status,
                'note'       => $p->note,
                'created_at' => $p->created_at->toDateTimeString(),
            ];
        }),
    ]);
});

Route::get('/service-status', function () {
    return response()->json(ServiceStatus::all());
});

Route::get('/service-statuses/{id}/logs', [ServiceStatusLogController::class, 'index']);

Route::get('/page-content/home', [HomePageController::class, 'getHeroContent']);
Route::get('/services', [HomePageController::class, 'getServices']);
Route::get('/support-links', [HomePageController::class, 'getSupportLinks']);
Route::get('/slideshow-images', [HomePageController::class, 'getSlideshowImages']);

Route::get('/guides', [GuideController::class, 'index']);
// Rute untuk testing koneksi dasar
Route::get('/test', function () {
    return response()->json([
        'message' => 'Halo dari Bandung!'
    ]);
});