<?php

namespace App\Http\Controllers;

use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use App\Models\OrganizationProfile;
use Illuminate\Support\Str;

class KategoriBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $profile = OrganizationProfile::first();
        $title = 'Data Artikel Berita';
        $kategori = KategoriBerita::latest()->get();
        return view('kategori.index', compact('kategori', 'profile', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profile = OrganizationProfile::first();
        $title = 'Tambah Data Artikel Berita';
        return view('kategori.create', compact('profile', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'nama' => 'required|string|max:100',
        'deskripsi' => 'nullable|string',
    ]);

    KategoriBerita::create($request->only(['nama', 'deskripsi']));

    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = KategoriBerita::findOrFail($id);
        $profile = OrganizationProfile::first();
        $title = 'Tambah Data Artikel Berita';
        return view('kategori.edit', compact('kategori', 'profile', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori = KategoriBerita::findOrFail($id);
        $kategori->nama = $request->nama;
        $kategori->deskripsi = $request->deskripsi;
        $kategori->slug = Str::slug($request->nama);
        $kategori->save();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = KategoriBerita::findOrFail($id);
        $kategori->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }
}
