<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kegiatan;
use App\Models\Member;
use App\Models\Notulen;
use App\Models\OrganizationProfile;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;

class NotulenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = OrganizationProfile::first();
        $title = 'Notulen Rapat';
        $notulens = Notulen::with('kegiatan')->latest()->paginate(10);
        return view('notulen.index', compact('notulens', 'profile', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profile = OrganizationProfile::first();
        $title = 'Tambah Notulen Rapat';
        $kegiatans = Kegiatan::doesntHave('notulen')->get();
        $members = Member::all();
        return view('notulen.create', compact('members', 'kegiatans', 'profile', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatans,id|unique:notulens,kegiatan_id',
            'isi_notulen' => 'required|string',
             'pemimpin_id' => 'required|exists:members,id',
        ]);

        Notulen::create($request->only('kegiatan_id', 'isi_notulen', 'pemimpin_id'));

        return redirect()->route('notulen.index')->with('success', 'Notulen berhasil ditambahkan.');
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
        $notulen = Notulen::findOrFail($id); // ambil data notulen yang akan diedit
        $profile = OrganizationProfile::first();
        $title = 'Edit Notulen Rapat';
         $kegiatans = Kegiatan::doesntHave('notulen')->orWhere('id', $notulen->kegiatan_id)->get(); // agar kegiatan lama tetap muncul
        $members = Member::all();
        return view('notulen.edit', compact('notulen','members', 'kegiatans', 'profile', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notulen $notulen)
    {
         $request->validate([
            'kegiatan_id' => 'required|string|max:255',
            'pemimpin_id' => 'required|exists:members,id',
            'isi_notulen' => 'required|string',
        ]);

        $notulen->update([
            'kegiatan_id' => $request->kegiatan_id,
            'pemimpin_id' => $request->pemimpin_id,
            'isi_notulen' => $request->isi_notulen
        ]);

        return redirect()->route('notulen.index')->with('success', 'Notulen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notulen $notulen)
    {
        $notulen->delete();
        return redirect()->route('notulen.index')->with('success', 'Notulen berhasil dihapus.');
    }

    public function downloadPDF(Notulen $notulen)
    {
        $kegiatan = $notulen->kegiatan;
        $jumlahHadir = Absensi::where('kegiatan_id', $kegiatan->id)
                          ->where('status', 'hadir')
                          ->distinct('anggota_id')
                          ->count('anggota_id');
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('notulen.pdf', compact('notulen', 'jumlahHadir'));
        return $pdf->download('Notulen-'.$notulen->kegiatan->nama.'.pdf');
    }
}
