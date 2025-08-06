<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('is_published', true)->latest()->paginate(10);
        return response()->json($news);
    }

    public function show(News $news)
    {
        if (!$news->is_published) {
            abort(404, 'Berita tidak ditemukan.');
        }
        $news->increment('views');
        return response()->json($news);
    }

    public function popular()
    {
        $popularNews = News::where('is_published', true)
                            ->orderByDesc('views')
                            ->take(3)
                            ->get();
        return response()->json(['data' => $popularNews]);
    }

    // 👇 METHOD INI DIPERBARUI AGAR LEBIH TANGGUH
    public function latest()
    {
        $popularNewsIds = News::where('is_published', true)
                                ->orderByDesc('views')
                                ->take(3)
                                ->pluck('id');

        $latestNews = News::where('is_published', true)
                           ->whereNotIn('id', $popularNewsIds)
                           ->orderByDesc('created_at')
                           ->take(3)
                           ->get();
        
        // JIKA SETELAH DI FILTER HASILNYA KURANG DARI 3 (ATAU KOSONG),
        // MAKA AMBIL SAJA 3 BERITA TERBARU TANPA PEDULI DUPLIKAT.
        if (count($latestNews) < 3) {
            $latestNews = News::where('is_published', true)
                               ->orderByDesc('created_at')
                               ->take(3)
                               ->get();
        }

        return response()->json(['data' => $latestNews]);
    }
}