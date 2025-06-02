<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lpj;
use App\Models\OrganizationProfile;
use App\Models\ProgramKerja;
use App\Models\Member;
use App\Models\LpjDokumentasi;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\PDF;

class LpjController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = OrganizationProfile::first();
        $title = 'Data LPJ';
        $lpjs = Lpj::with(['programKerja', 'penanggungJawab', 'dokumentasi'])->latest()->get();
        return view('lpj.index', compact('lpjs', 'profile', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profile = OrganizationProfile::first();
        $title = 'Tambah LPJ';
        $programKerjas = ProgramKerja::all();
        $members = Member::all();
        return view('lpj.create', compact('programKerjas', 'members', 'profile', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'program_kerja_id' => 'required|exists:program_kerjas,id',
            'ketua_pelaksana_id' => 'required|exists:members,id',
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'anggaran_dana' => 'required|numeric',
            'dana_terealisasi' => 'required|numeric',
            'ringkasan' => 'nullable|string',
            'dokumentasi.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $lpj = Lpj::create($request->only([
            'program_kerja_id', 'ketua_pelaksana_id', 'nama_kegiatan',
            'tanggal_pelaksanaan', 'anggaran_dana', 'dana_terealisasi'
        ]));

        // Simpan dokumentasi
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $path = $file->store('lpj_dokumentasi', 'public');
                LpjDokumentasi::create([
                    'lpj_id' => $lpj->id,
                    'file_path' => $path
                ]);
            }
        }

        return redirect()->route('lpj.index')->with('success', 'LPJ berhasil ditambahkan.');
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
        $title = 'Edit LPJ';
        $lpj = Lpj::with('dokumentasi')->findOrFail($id);
        $programKerjas = ProgramKerja::all();
        $members = Member::all();
        return view('lpj.edit', compact('lpj', 'programKerjas', 'members', 'profile', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lpj = Lpj::findOrFail($id);

        $request->validate([
            'program_kerja_id' => 'required|exists:program_kerjas,id',
            'ketua_pelaksana_id' => 'required|exists:members,id',
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'anggaran_dana' => 'required|numeric',
            'dana_terealisasi' => 'required|numeric',
            'dokumentasi.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $lpj->update($request->only([
            'program_kerja_id', 'ketua_pelaksana', 'nama_kegiatan',
            'tanggal_pelaksanaan', 'anggaran_dana', 'dana_terealisasi'
        ]));

        // Tambah dokumentasi baru jika ada
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $path = $file->store('lpj_dokumentasi', 'public');
                LpjDokumentasi::create([
                    'lpj_id' => $lpj->id,
                    'file_path' => $path
                ]);
            }
        }

        return redirect()->route('lpj.index')->with('success', 'LPJ berhasil diperbarui.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lpj = Lpj::findOrFail($id);

        // Hapus dokumentasi LPJ
        foreach ($lpj->dokumentasi as $dok) {
            Storage::disk('public')->delete($dok->file_path);
            $dok->delete();
        }

        $lpj->delete();

        return redirect()->route('lpj.index')->with('success', 'LPJ berhasil dihapus.');
    }

    public function exportPdf($id)
    {
        ini_set('memory_limit', '512M'); // naikkan memory limit sementara
        
        $lpj = Lpj::with(['penanggungJawab', 'dokumentasi'])->findOrFail($id);
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('lpj.export_pdf', compact('lpj'));
        return $pdf->download('lpj_' . $lpj->nama_kegiatan . '.pdf');
    }
}
