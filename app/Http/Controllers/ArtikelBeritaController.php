<?php

namespace App\Http\Controllers;

use App\Models\ArtikelBerita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use App\Models\OrganizationProfile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArtikelBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = OrganizationProfile::first();
        $title = 'Data Artikel Berita';
        $artikel = ArtikelBerita::with('kategori')->paginate(10);
        return view('artikel.index', compact('artikel', 'profile', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profile = OrganizationProfile::first();
        $title = 'Tambah Data Artikel Berita';
        $kategori = KategoriBerita::all();
        return view('artikel.create', compact('kategori', 'profile', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'judul' => 'required',
        'isi' => 'required',
        'thumbnail' => 'nullable|image',
        'status' => 'required',
        'kategori_id' => 'nullable|exists:kategori_beritas,id',
    ]);

    if ($request->hasFile('thumbnail')) {
        $validated['thumbnail'] = $request->file('thumbnail')->store('artikel_thumbnails', 'public');
    }

    $validated['penulis'] = auth()->user()->name ?? 'admin';

    ArtikelBerita::create($validated);
    return redirect()->route('artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $artikel = ArtikelBerita::findOrFail($id);
        $profile = OrganizationProfile::first();
        $title = 'Edit Artikel Berita';
        $kategori = KategoriBerita::all();
        return view('artikel.edit', compact('artikel','kategori', 'profile', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'judul' => 'required|string|max:255',
        'isi' => 'required|string',
        'kategori_id' => 'nullable|exists:kategori_beritas,id',
        'status' => 'required|in:draft,publish',
        'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $artikel = ArtikelBerita::findOrFail($id);

    // Update data dasar
    $artikel->judul = $request->judul;
    $artikel->isi = $request->isi;
    $artikel->kategori_id = $request->kategori_id;
    $artikel->status = $request->status;
    $artikel->penulis = auth()->user()->name ?? 'admin';
    $artikel->slug = Str::slug($request->judul);

    // Cek jika ada file gambar baru
    if ($request->hasFile('gambar')) {
        // Hapus gambar lama jika ada
        if ($artikel->thumbnail && Storage::exists('public/' . $artikel->thumbnail)) {
            Storage::delete('public/' . $artikel->thumbnail);
        }

        // Simpan gambar baru
        $path = $request->file('thumbnail')->store('artikel_thumbnails', 'public');
        $artikel->thumbnail = $path;
    }

    $artikel->save();

    return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
