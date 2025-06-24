<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\OrganizationProfile;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PengumumanAnggotaController extends Controller
{ 
    public function index()
    {
        $profile = OrganizationProfile::first();
        $title = 'Pengumuman';
        $user = Auth::user();

        // Ambil pengumuman yang aktif hari ini atau akan datang
        $pengumuman = Pengumuman::whereDate('tanggal_selesai', '>=', now())
            ->orderBy('tanggal_mulai', 'desc')
            ->get();

        return view('anggota.pengumuman.index', compact('profile','pengumuman', 'title', 'user'));
    }
}
