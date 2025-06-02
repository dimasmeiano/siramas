<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrganizationProfile;
use Illuminate\Support\Facades\Storage;

class OrganizationProfileController extends Controller
{
    public function edit()
    {
        $title = 'Profil Organisasi';
        $profile = OrganizationProfile::first() ?? new OrganizationProfile();
        return view('organization_profile.index', compact('profile', 'title'));
    }

    public function update(Request $request)
{
    $data = $request->validate([
        'nama_organisasi' => 'required|string',
        'visi' => 'nullable|string',
        'misi' => 'nullable|string',
        'alamat_sekretariat' => 'nullable|string',
        'no_hp' => 'nullable|string',
        'link_youtube' => 'nullable|string',
        'link_instagram' => 'nullable|string',
        'link_facebook' => 'nullable|string',
        'logo' => 'nullable|image|max:2048',
        'foto_masjid' => 'nullable|image|max:4096',
    ]);

     $profile = OrganizationProfile::first();

    if (!$profile) {
        // Jika belum ada profil, buat baru
        $profile = new OrganizationProfile();
    }

    if ($request->hasFile('logo')) {
        // Hapus logo lama jika ada
        if ($profile->logo && Storage::exists('public/' . $profile->logo)) {
            Storage::delete('public/' . $profile->logo);
        }

        // Simpan logo baru
        $data['logo'] = $request->file('logo')->store('logo', 'public');
    }

    if ($request->hasFile('foto_masjid')) {
        // Hapus foto lama jika ada
        if ($profile->foto_masjid && Storage::exists('public/' . $profile->foto_masjid)) {
            Storage::delete('public/' . $profile->foto_masjid);
        }

        // Simpan foto masjid baru
        $data['foto_masjid'] = $request->file('foto_masjid')->store('foto_masjid', 'public');
    }

    $profile->fill($data);
    $profile->save();

    return redirect()->back()->with('success', 'Profil organisasi berhasil diperbarui.');
}
}
