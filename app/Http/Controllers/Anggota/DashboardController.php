<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Cuti;
use App\Models\OrganizationProfile;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $profile = OrganizationProfile::first();
        $title = 'Dashboard';
        $user = \Illuminate\Support\Facades\Auth::user();
        $chats = [
        (object)[
            'name' => 'Work Notice: PT. Jenggala',
            'last_message' => '[Attendance] Saatnya absensi ...',
            'time' => '18:00'
        ],
        (object)[
            'name' => 'SeaTalk Team',
            'last_message' => '[SeaTalk Assistant] Selamat, Anda...',
            'time' => 'Tuesday'
        ],
        (object)[
            'name' => 'Dimas Meilano Dwi S...',
            'last_message' => 'p',
            'time' => 'Tuesday'
        ],
    ];

        $pengumuman = Pengumuman::orderBy('tanggal_mulai', 'desc')->take(5)->get();
        $checkinToday = Absensi::whereDate('waktu_absen', now())->where('anggota_id', $user->id)->exists();
        $sisaCuti = Cuti::where('user_id', optional($user)->id)
    ->where('status', 'approved')
    ->get()
    ->sum(function ($cuti) {
        return $cuti->tanggal_mulai->diffInDays($cuti->tanggal_selesai) + 1;
    });
        $tugasAktif = 3; // placeholder, bisa ganti dari modul task

        return view('anggota.dashboard.index', compact('profile', 'title', 'pengumuman', 'checkinToday', 'sisaCuti', 'tugasAktif', 'chats'));
    }
}
