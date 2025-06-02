<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keuangan;
use App\Models\ProgramKerja;
use App\Exports\KeuanganExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\OrganizationProfile;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $profile = OrganizationProfile::first();
        $title = 'Keuangan';
        $programKerjaList = ProgramKerja::all();

        $query = Keuangan::query();

        if ($request->filled('program_kerja_id')) {
            $query->where('program_kerja_id', $request->program_kerja_id);
        }

        if ($request->filled('periode')) {
            switch ($request->periode) {
                case 'mingguan':
                    $query->whereBetween('tanggal', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'bulanan':
                    $query->whereMonth('tanggal', now()->month);
                    break;
                case 'tahunan':
                    $query->whereYear('tanggal', now()->year);
                    break;
            }
        }

        $keuangan = $query->orderBy('tanggal', 'desc')->paginate(15)->withQueryString();

        return view('keuangan.index', compact('keuangan', 'profile', 'title', 'programKerjaList'));
    }

    private function getFilteredData(Request $request)
    {
        $query = Keuangan::query();

        if ($request->filled('program_kerja_id')) {
            $query->where('program_kerja_id', $request->program_kerja_id);
        }

        if ($request->filled('periode')) {
            switch ($request->periode) {
                case 'mingguan':
                    $query->whereBetween('tanggal', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'bulanan':
                    $query->whereMonth('tanggal', now()->month);
                    break;
                case 'tahunan':
                    $query->whereYear('tanggal', now()->year);
                    break;
            }
        }

        return $query->orderBy('tanggal', 'desc')->get();
    }

    public function exportPdf(Request $request)
    {
        $data = $this->getFilteredData($request);

        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('keuangan.export_pdf', ['keuangan' => $data]);
        return $pdf->download('laporan_keuangan.pdf');
    }

    public function exportExcel(Request $request)
    {
        $data = $this->getFilteredData($request);

        return Excel::download(new KeuanganExport($data), 'laporan_keuangan.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profile = OrganizationProfile::first();
        $title = 'Tambah Keuangan';
        $programKerja = ProgramKerja::all();
        return view('keuangan.create', compact('programKerja', 'profile', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'program_kerja_id' => 'nullable|exists:program_kerjas,id',
            'tanggal' => 'required|date',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'nominal' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        Keuangan::create($request->all());

        return redirect()->route('keuangan.index')->with('success', 'Data keuangan berhasil disimpan.');
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
        $profile = OrganizationProfile::first();
        $title = 'Edit Keuangan';
        $keuangan = Keuangan::findOrFail($id);
        $programKerja = ProgramKerja::all();
        return view('keuangan.edit', compact('keuangan', 'programKerja', 'profile', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'program_kerja_id' => 'nullable|exists:program_kerjas,id',
            'tanggal' => 'required|date',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'nominal' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        $keuangan = Keuangan::findOrFail($id);
        $keuangan->update($request->all());

        return redirect()->route('keuangan.index')->with('success', 'Data keuangan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $keuangan = Keuangan::findOrFail($id); // cari data pengurus berdasarkan ID

        $keuangan->delete(); // hapus data

        return redirect()->route('keuangan.index')->with('success', 'Data keuangan berhasil dihapus.');
    }
}
