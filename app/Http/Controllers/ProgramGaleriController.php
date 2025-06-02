<?php

namespace App\Http\Controllers;

use App\Models\OrganizationProfile;
use App\Models\ProgramGaleri;
use App\Models\ProgramKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramGaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($programId)
    {
        $title = 'Galeri';
        $profile = OrganizationProfile::first();
        $program = ProgramKerja::findOrFail($programId);
        $galeri = $program->galerifoto()->orderBy('order')->get();

        return view('program_galeri.index', compact('program', 'galeri', 'title', 'profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($programId)
    {
        $title = 'Galeri';
        $profile = OrganizationProfile::first();
        $program = ProgramKerja::findOrFail($programId);

        return view('program_galeri.create', compact('program', 'title', 'profile'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $programId)
    {
         $request->validate([
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'captions.*' => 'nullable|string|max:255',
        ]);

        $program = ProgramKerja::findOrFail($programId);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                $path = $photo->store('program_galeri', 'public');
                $program->galerifoto()->create([
                    'photo_path' => $path,
                    'caption' => $request->captions[$index] ?? null,
                    'order' => 0,
                ]);
            }
        }

        return redirect()->route('program_galeri.index', $programId)
                         ->with('success', 'Foto berhasil diupload.');
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
    public function edit(string $id, $programId)
    {
         $title = 'Edit Galeri';
        $profile = OrganizationProfile::first();
        $program = ProgramKerja::findOrFail($programId);
        $foto = ProgramGaleri::findOrFail($id);

        return view('program_galeri.edit', compact('program', 'foto', 'profile', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, $programId)
    {
        $foto = ProgramGaleri::findOrFail($id);

        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'caption' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            // Hapus file lama jika perlu
            \Storage::disk('public')->delete($foto->photo_path);

            $path = $request->file('photo')->store('program_galeri', 'public');
            $foto->photo_path = $path;
        }

        $foto->caption = $request->caption;
        $foto->save();

        return redirect()->route('program_galeri.index', $programId)
                         ->with('success', 'Foto berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($programId, string $id)
    {
        $foto = ProgramGaleri::where('program_kerjas_id', $programId)->findOrFail($id);

    // Hapus file fisik
    if ($foto->photo_path && Storage::disk('public')->exists($foto->photo_path)) {
        Storage::disk('public')->delete($foto->photo_path);
    }

        $foto->delete();

        return redirect()->route('program_galeri.index', $programId)
                         ->with('success', 'Foto berhasil dihapus.');
    }

    public function reorder(Request $request, $programId)
{
    $validated = $request->validate([
        'order' => 'required|array',
        'order.*.id' => 'required|integer|exists:program_galeris,id',
        'order.*.order' => 'required|integer|min:1',
    ]);

    foreach ($validated['order'] as $item) {
        ProgramGaleri::where('id', $item['id'])
            ->where('program_kerjas_id', $programId)
            ->update(['order' => $item['order']]);
    }

    return response()->json(['status' => 'ok']);
}
}

