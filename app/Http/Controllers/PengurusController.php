<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Pengurus;
use App\Models\Departement;
use App\Models\OrganizationProfile;

class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = OrganizationProfile::first();
        $title = 'Pengurus';
        $pengurus = Pengurus::with('member', 'departement')->get();
        return view('pengurus.index', compact('pengurus', 'profile', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profile = OrganizationProfile::first();
        $title = 'Tambah Pengurus';
        $member = Member::with('departement')->get();
        $departement = Departement::all();
        return view('pengurus.create', compact('member', 'profile', 'departement', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'member_id' => 'required|exists:members,id',
        'departement_id' => 'required|exists:departements,id',
        'tanggal_mulai' => 'required|string|max:255',
        'tanggal_akhir' => 'required|string|max:255',
    ]);

    //dd($request->all());
     $pengurus = Pengurus::create([
        'member_id' => $request->member_id,
        'departement_id' => $request->departement_id,
        'tanggal_mulai' => $request->tanggal_mulai,
        'tanggal_akhir' => $request->tanggal_akhir,
    ]);

    return redirect()->route('pengurus.index')->with('success', 'Data pengurus berhasil disimpan.');
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
        // Cari data pengurus berdasarkan id, otomatis 404 jika tidak ditemukan
        $pengurus = Pengurus::findOrFail($id);

        // Ambil data pendukung untuk form dropdown
        $profile = OrganizationProfile::first();
        $members = Member::with('departement')->get();
        $departements = Departement::all();

        $title = 'Edit Pengurus';

        // Tampilkan view edit dengan data yang sudah di-load
        return view('pengurus.edit', compact('pengurus', 'members', 'departements', 'profile', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         // Validasi input data
        $validatedData = $request->validate([
            'member_id' => 'required|exists:members,id',
            'departement_id' => 'required|exists:departements,id',
            'tanggal_mulai' => 'required|string|max:255',
            'tanggal_akhir' => 'required|string|max:255',
        ]);

        // Cari data pengurus berdasarkan id, kalau tidak ada akan 404 otomatis
        $pengurus = Pengurus::findOrFail($id);

        // Update data pengurus
        $pengurus->update($validatedData);

        // Redirect ke halaman daftar pengurus dengan pesan sukses
        return redirect()->route('pengurus.index')->with('success', 'Data pengurus berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengurus = Pengurus::findOrFail($id);
        $pengurus->delete();

        return redirect()->route('pengurus.index')->with('success', 'Data pengurus berhasil dihapus.');
    }
}
