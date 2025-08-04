<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HeroContent;
use App\Models\Service;
use App\Models\SupportLink;
use Illuminate\Http\Request;
use App\Models\SlideshowImage;

class HomePageController extends Controller
{
    public function getHeroContent()
    {
        // Ambil data hero section pertama yang ada
        $content = HeroContent::first(); 
        return response()->json($content);
    }

    public function getServices()
    {
        $services = Service::all();
        // Untuk production, Anda bisa menambahkan title dan description section di sini
        return response()->json([
            'title' => 'Layanan Yang Tersedia',
            'description' => 'Layanan teknologi informasi yang dapat diakses oleh seluruh civitas Yayasan Taruna Bakti.',
            'items' => $services,
        ]);
    }

    public function getSupportLinks()
    {
        $supportLinks = SupportLink::all();
        // Anda bisa tambahkan title dan description juga
        return response()->json([
            'title' => 'Pusat Dukungan & Bantuan',
            'description' => 'Temukan informasi status layanan terkini, pertanyaan yang sering diajukan (FAQ), dan ajukan permintaan layanan atau bantuan teknis dengan mudah.',
            'items' => $supportLinks,
        ]);
    }

    public function getSlideshowImages()
    {
    // Ambil semua path gambar yang statusnya aktif
    $images = SlideshowImage::where('is_active', true)->pluck('image_path');
    return response()->json($images);
    }
}