<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\BukuTamu;
use App\Models\Inventaris;
use App\Models\Keuangan;
use App\Models\Member;
use App\Models\OrganizationProfile;
use App\Models\ProgramKerja;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = OrganizationProfile::first();
        $title = 'Dashboard';

        // Jumlah anggota
        $jumlahAnggota = Member::count();

        // Data absensi bulanan (hadir saja misalnya)
        $absensiData = Absensi::selectRaw("DATE_FORMAT(waktu_absen, '%Y-%m') as bulan, COUNT(*) as total")
            ->where('status', 'hadir')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Data keuangan masuk dan keluar per bulan
        $keuanganData = Keuangan::selectRaw("DATE_FORMAT(tanggal, '%Y-%m') as bulan, 
                SUM(IF(jenis='pemasukan', nominal, 0)) as pemasukan,
                SUM(IF(jenis='pengeluaran', nominal, 0)) as pengeluaran")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Progress program kerja (contoh: dari 100%)
        $programs = ProgramKerja::select('nama', 'status')->get();

        return view('admin.dashboard.index', compact(
            'profile', 'title', 'jumlahAnggota',
            'absensiData', 'keuanganData', 'programs', 'totalTamuHariIni',
            'totalTamuBulanIni', 'totalTamu', 'totalBarang', 'barangRusak',
            'barangDipinjam', 'barangHilang'
        ));
    }
}
