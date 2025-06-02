<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\OrganizationProfile;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    // Untuk anggota: kegiatan aktif (tanggal sekarang antara mulai-selesai)
    public function aktif()
    {
        $now = now()->toDateString();

        $kegiatanAktif = Kegiatan::where('tanggal_mulai', '<=', $now)
            ->where('tanggal_selesai', '>=', $now)
            ->get();

        return response()->json($kegiatanAktif);
    }

    // Admin CRUD
    public function index()
    {
        $profile = OrganizationProfile::first();
        $title = 'Kegiatan';
        $kegiatan =  Kegiatan::withCount(['absensi as jumlah_absen' => function ($query) {
                    $query->distinct('anggota_id');
                    }])->get();
        return view('kegiatan.index', compact('profile','title','kegiatan'));
    }

    public function create()
    {
        $profile = OrganizationProfile::first();
        $title = 'Kegiatan';
        return view('kegiatan.create', compact('profile', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        Kegiatan::create($request->all());

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan dibuat');
    }

    public function edit(Kegiatan $kegiatan)
    {
        $profile = OrganizationProfile::first();
        $title = 'Kegiatan';
        return view('kegiatan.edit', compact('kegiatan', 'title', 'profile'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'nama' => 'required',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $kegiatan->update($request->all());

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan diperbarui');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan dihapus');
    }
}
