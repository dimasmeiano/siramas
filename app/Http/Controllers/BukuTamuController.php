<?php

namespace App\Http\Controllers;

use App\Exports\BukuTamuExport;
use App\Models\BukuTamu;
use App\Models\OrganizationProfile;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class BukuTamuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = BukuTamu::query();

        // Filter berdasarkan nama
        if ($request->filled('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        // Filter berdasarkan instansi
        if ($request->filled('instansi')) {
            $query->where('instansi', '<=', $request->instansi);
        }

        // Filter berdasarkan kontak
        if ($request->filled('kontak')) {
            $query->where('kontak', 'like', '%' . $request->kontak . '%');
        }

        // Filter berdasarkan tanggal mulai dan selesai (filter tanggal kunjungan)
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('created_at', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('created_at', '<=', $request->tanggal_selesai);
        }


        $title = 'Buku Tamu';
        $profile = OrganizationProfile::first();
        $tamus = $query->orderBy('waktu_kunjungan', 'desc')->paginate(10);
        return view('buku_tamu.index', compact('tamus', 'title', 'profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function exportExcel()
    {
       return Excel::download(new BukuTamuExport, 'tes_buku_tamu.xlsx');
    }

    public function exportPdf()
    {
        $data = BukuTamu::all();
        $pdf = Pdf::loadView('buku_tamu.pdf', compact('data'));
        return $pdf->download('buku_tamu.pdf');
    }
}
