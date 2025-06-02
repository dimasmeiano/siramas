<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use Maatwebsite\Excel\Excel;
use App\Models\OrganizationProfile;

class AbsensiController extends Controller
{
    public function index() {
        $profile = OrganizationProfile::first();
        $title = 'Data Artikel Berita';
        $absensis = Absensi::with(['anggota', 'kegiatan'])->latest()->paginate(10);

        return view('absensi.index', compact('absensis', 'profile', 'title'));
    }

    // Admin lihat laporan absensi PDF
    public function laporan(Kegiatan $kegiatan)
    {
        $absensi = $kegiatan->absensi()->with('user')->get();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.absensi.laporan_pdf', compact('kegiatan', 'absensi'));
        return $pdf->download("laporan-absensi-{$kegiatan->id}.pdf");
    }

    // Admin export Excel
    public function exportExcel(Kegiatan $kegiatan)
    {
        return Excel::download(new AbsensiExport($kegiatan->id), 'laporan-absensi.xlsx');
    }
}
