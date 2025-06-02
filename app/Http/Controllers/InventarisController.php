<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\OrganizationProfile;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Inventaris::query();

        if ($request->filled('nama_barang')) {
            $query->where('nama_barang', 'like', '%' . $request->nama_barang . '%');
        }
        $title = 'Daftar Inventaris';
        $profile = OrganizationProfile::first();
        $inventaris = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('inventaris.index', compact('inventaris', 'title', 'profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Daftar Inventaris';
        $profile = OrganizationProfile::first();
        return view('inventaris.create', compact('title', 'profile'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|in:Baik,Rusak,Dipinjam,Hilang',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_perolehan' => 'nullable|date',
        ]);

        Inventaris::create($request->all());

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil ditambahkan.');
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
    public function edit(Inventaris $inventari)
    {
        $title = 'Edit Daftar Inventaris';
        $profile = OrganizationProfile::first();
        return view('inventaris.edit', compact('inventari', 'title', 'profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventaris $inventari)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jumlah' => 'required|integer|min:1',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_perolehan' => 'nullable|date',
        ]);

        $inventari->update($request->all());

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventaris $inventari)
    {
        $inventari->delete();
        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil dihapus.');
    }
}
