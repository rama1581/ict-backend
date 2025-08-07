<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    /**
     * Menampilkan daftar panduan, dengan fitur pencarian.
     */
    public function index(Request $request)
    {
        $guides = Guide::query()
            ->when($request->search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('category', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return response()->json(['data' => $guides]);
    }

    /**
     * Menampilkan detail satu panduan berdasarkan slug.
     */
    public function show(string $slug)
    {
        $guide = Guide::where('slug', $slug)->firstOrFail();
        return response()->json($guide);
    }
}