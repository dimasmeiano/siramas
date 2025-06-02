<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ArtikelBerita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $artikel = ArtikelBerita::latest()->paginate(6); // atau ->get()
        return view('frontend.berita.index', compact('artikel'));
    }

    public function show($slug)
    {
        $kategori = KategoriBerita::withCount('artikel')->get();
        $artikel = ArtikelBerita::where('slug', $slug)->with(['comments.replies'])->firstOrFail();
        $latestCourses = ArtikelBerita::latest()->take(3)->get();
        return view('frontend.berita.show', compact('artikel', 'kategori', 'latestCourses'));
    }
}
