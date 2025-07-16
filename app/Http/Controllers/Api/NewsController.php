<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Menampilkan daftar semua news.
     */
    public function index()
    {
        // Query disederhanakan, tidak perlu relasi
        $news = News::latest()->paginate(10);
        return response()->json($news);
    }

    /**
     * Menampilkan satu news spesifik.
     */
    public function show(News $news)
    {
        // Cukup kembalikan data news itu sendiri
        return response()->json($news);
    }
}