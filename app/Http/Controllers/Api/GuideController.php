<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil kata kunci pencarian dari parameter URL (?search=...)
        $query = $request->input('search');

        $guides = Guide::query()
            ->when($query, function ($q) use ($query) {
                // Mencari di kolom 'title' atau 'category'
                return $q->where('title', 'like', "%{$query}%")
                         ->orWhere('category', 'like', "%{$query}%");
            })
            ->latest() // Urutkan dari yang terbaru
            ->get();

        return response()->json(['data' => $guides]);
    }
}