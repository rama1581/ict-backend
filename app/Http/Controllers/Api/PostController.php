<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Mengembalikan daftar semua post
    public function index()
    {
    // Kembalikan ke query awal yang menyertakan relasi dan paginasi
    $posts = \App\Models\Post::latest()
        ->with(['category', 'author']) // <-- Ini bagian penting yang mengambil data relasi
        ->paginate(10); 

    return response()->json($posts);
    }

    // Mengembalikan satu post spesifik
    public function show(Post $post) // Laravel otomatis mencari Post berdasarkan slug
    {
        // Cukup load relasinya dan kembalikan sebagai JSON
        return response()->json($post->load(['category', 'author']));
    }
}