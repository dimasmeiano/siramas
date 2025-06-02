<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramKerja;
use App\Models\Member;
use App\Models\ProgramKerjaFile;
use App\Models\OrganizationProfile;
use App\Models\TemplateProgramKerja;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProgramKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = OrganizationProfile::first();
        $title = 'Program Kerja';
        $programs = ProgramKerja::with('pics')->latest()->get();
        return view('program_kerja.index', compact('programs', 'profile' ,'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profile = OrganizationProfile::first();
        $title = 'Tambah Program Kerja';
        $members = Member::all();
        return view('program_kerja.create', compact('members', 'profile', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'is_template' => 'nullable|boolean',
            'pics' => 'array',
            'pics.*' => 'exists:members,id',
            'files.*' => 'nullable|file|max:10240',
        ]);

        DB::beginTransaction();
    try {
        $program = ProgramKerja::create(array_merge($data, [
    'created_by' => auth()->id()
]));

         if (!empty($data['pics']) && is_array($data['pics'])) {
            $program->pics()->attach($data['pics']);
        }

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $path = $file->storeAs(
                        'program_kerja_files',
                        uniqid() . '_' . $file->getClientOriginalName(),
                        'public'
                    );
                ProgramKerjaFile::create([
                    'program_kerja_id' => $program->id,
                    'filename' => $file->getClientOriginalName(),
                    'filepath' => $path,
                ]);
            }
        }

        if ($request->has('is_template') && $request->is_template == 1) {
            TemplateProgramKerja::create([
                'nama' => $program->nama,
                'deskripsi' => $program->deskripsi,
                'interval' => $request->interval ?? 'bulanan',
                'auto_generate' => $request->boolean('auto_generate'),
            ]);
        }

        DB::commit();
        return redirect()->route('program-kerja.index')->with('success', 'Program kerja berhasil ditambahkan.');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
    }
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
    public function edit(ProgramKerja $programKerja)
    {
        $programKerja->load('pics');  // Load relasi tanpa query ulang findOrFail
        $profile = OrganizationProfile::first();
        $members = Member::all(); // Bisa ditambah paginate() jika perlu

        $title = 'Edit Program Kerja';
        return view('program_kerja.edit', compact('programKerja', 'members', 'profile', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramKerja $programKerja)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'pics' => 'array',
            'pics.*' => 'exists:members,id',
        ]);
        // Debug info: cek program id dan pics
         Log::info('Update program', ['program_id' => $programKerja->id, 'pics' => $data['pics'] ?? []]);

        $programKerja->update($data);
        // Tambahkan pengecekan eksplisit
        Log::info('Program instance before sync', [
            'id' => $programKerja->id,
            'exists' => $programKerja->exists,
            'key' => $programKerja->getKey(),
            'pics' => $data['pics'] ?? [],
        ]);
        $programKerja->refresh(); // <-- memastikan model fresh dari database
        // Sync pics jika ada
        if (isset($data['pics'])) {
            $programKerja->pics()->sync($data['pics']);
        } else {
            $programKerja->pics()->detach(); // Jika tidak ada pics dikirim, hapus semua pics yg terkait
        }
        // Handle file uploads
        if ($request->hasFile('file')) {
    $file = $request->file('file');
    $path = $file->storeAs(
        'program_kerja_files',
        uniqid() . '_' . $file->getClientOriginalName(),
        'public'
    );

    ProgramKerjaFile::create([
        'program_kerja_id' => $programKerja->id,
        'filename' => $file->getClientOriginalName(),
        'filepath' => $path,
    ]);
        }

        return redirect()->route('program-kerja.index')->with('success', 'Program kerja berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramKerja $programKerja)
    {
        $programKerja->pics()->detach();

        foreach ($programKerja->files as $file) {
            Storage::delete('public/' . $file->path);
            $file->delete();
        }

        $programKerja->delete();

        return redirect()->route('program-kerja.index')->with('success', 'Program kerja berhasil dihapus.');
    }

    public function downloadFile($id)
    {
        $file = ProgramKerjaFile::findOrFail($id);
        return Storage::download('public/' . $file->path, $file->nama_file);
    }

    public function duplicate($id)
    {
        $original = ProgramKerja::with('pics')->findOrFail($id);

        $new = $original->replicate(['is_template']);
        $new->nama = $original->nama . ' (Copy)';
        $new->save();

        $new->pics()->attach($original->pics->pluck('id')->toArray());

        return redirect()->route('program-kerja.index')->with('success', 'Program kerja berhasil diduplikasi.');
    }
}
