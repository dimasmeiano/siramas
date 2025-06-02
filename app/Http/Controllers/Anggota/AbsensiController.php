<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Absensi;
use App\Models\OrganizationProfile;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    // Tampilkan halaman form absensi untuk kegiatan aktif
    public function index()
    {
        $profile = OrganizationProfile::first();
        $title = "Absensi Anggota";
        // Ambil kegiatan yang sedang berlangsung / aktif hari ini
        $now = now();
        $kegiatanAktif = Kegiatan::where('waktu_mulai', '<=', $now)
                                ->where(function($q) use ($now) {
                                    $q->where('waktu_selesai', '>=', $now)
                                      ->orWhereNull('waktu_selesai');
                                })
                                ->get();
        // Ambil anggota_id dari user yang login
        $anggotaId = Auth::user()->member_id;

        // Ambil data absensi berdasarkan anggota_id
        $absensis = Absensi::with('kegiatan') // relasi ke tabel kegiatan
                        ->where('anggota_id', $anggotaId)
                        ->orderBy('waktu_absen', 'desc')
                        ->get();

        return view('anggota.absensi.index', compact('kegiatanAktif', 'absensis', 'profile', 'title'));
    }

    // Simpan data absensi anggota
    public function store(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatans,id',
        ]);

        $anggota_id = Auth::user()->member_id; // asumsi login pake akun anggota

        // Cek apakah anggota sudah absen di kegiatan ini
        $absenExist = Absensi::where('kegiatan_id', $request->kegiatan_id)
                            ->where('anggota_id', $anggota_id)
                            ->first();

        if ($absenExist) {
            return redirect()->back()->with('error', 'Anda sudah melakukan absensi untuk kegiatan ini.');
        }

        Absensi::create([
            'kegiatan_id' => $request->kegiatan_id,
            'anggota_id' => $anggota_id,
            'waktu_absen' => now(),
            'status' => 'hadir',
        ]);

        return redirect()->back()->with('success', 'Absensi berhasil dicatat.');
    }
}
