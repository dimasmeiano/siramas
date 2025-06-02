<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Departement;
use Illuminate\Support\Str;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\OrganizationProfile;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = OrganizationProfile::first();
        $title = 'Data Anggota';
        $members = Member::with('departement')->paginate(10);
        return view('members.index', compact('members', 'profile', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profile = OrganizationProfile::first();
        $title = 'Tambah Anggota';
        $departement = Departement::all();
        return view('members.create', compact('departement','profile', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_hp' => 'nullable',
            'email' => 'required|email|unique:members,email',
            'alamat' => 'required',
            'pendidikan_terakhir' => 'nullable',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data['is_active'] = 1; // Set default is_active to 1
        // foto anggota
        if ($request->hasFile('foto')) {
           $data['foto'] = $request->file('foto')->store('foto', 'public');
        }

        // Generate NIA
        $prefix = 'RAK-' . date('Ym') . '-';
        $lastMember = Member::where('nia', 'like', $prefix . '%')->orderBy('nia', 'desc')->first();
        $number = $lastMember ? intval(substr($lastMember->nia, -4)) + 1 : 1;
        $data['nia'] = $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
       
        $member = Member::create($data);

        // Ambil data QR (misalnya NIA anggota)
        $qrContent = $member->nia; // atau string lain sesuai kebutuhan

       // Buat QR Code
       $qrCode = new QrCode($member->nia);

        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        $qrPath = 'qrcodes/' . Str::slug($member->nia) . '.png';
        $qrFullPath = storage_path('app/public/' . $qrPath);

        // Simpan file ke storage
        file_put_contents($qrFullPath, $result->getString());

        // Simpan path QR ke database
        $member->update(['qr_code' => $qrPath]);

        // Buat user terkait dari email member (username = email)
        $user = User::create([
            'member_id' => $member->id,
            'username' => $member->email,
            'password' => Hash::make('password123'), // Default password (harus diganti)
        ]);

        // Beri role default 'anggota' (id = 2)
        $user->roles()->attach(2);

        // QR Code
        $qrContent = $member->nia;
        $qrCode = new QrCode($qrContent);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        $qrPath = 'qrcodes/' . Str::slug($member->nia) . '.png';
        $qrFullPath = storage_path('app/public/' . $qrPath);
        file_put_contents($qrFullPath, $result->getString());
        
       return redirect()->route('members.index')->with('success', 'Anggota ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $profile = OrganizationProfile::first();
        $title = 'Detail Anggota';
        $member = Member::with(['user.roles', 'pengurus.departement', 'departement'])->findOrFail($id);

        return view('members.show', compact('member', 'profile', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $profile = OrganizationProfile::first();
        $title = 'Edit Anggota';
        // Ambil data member berdasarkan ID
        $member = Member::findOrFail($id);

        // Tampilkan view form edit
        return view('members.edit', compact('member', 'profile', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $member = Member::findOrFail($id);
        // Simpan email lama sebelum diubah
        $oldEmail = $member->email;

        // Validasi input
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string|max:255',
            'pendidikan_terakhir' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Cek apakah email berubah
        if ($validated['email'] !== $member->email) {
            // Update email di tabel users jika relasi tersedia
            if ($member->user) {
                $member->user->username = $validated['email'];
                $member->user->save();
            }
        }

        // Update data dasar
        $member->fill($validated);

        // Proses upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($member->foto && Storage::exists('public/' . $member->foto)) {
                Storage::delete('public/' . $member->foto);
            }

            // Simpan foto baru
            $path = $request->file('foto')->store('foto_anggota', 'public');
            $member->foto = $path;
        }

        $member->save();

        return redirect()->route('members.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari member berdasarkan id, kalau tidak ditemukan otomatis throw 404
        $member = Member::findOrFail($id);

        // Jika ada file foto, hapus dulu dari storage
        if ($member->foto) {
            Storage::delete($member->foto);
        }
        // Jika ada file qr code, hapus dulu dari storage
        if ($member->qr_code) {
            Storage::delete($member->qr_code);
        }

        // Hapus data member dari database
        $member->delete();

        // Redirect kembali ke halaman list member dengan pesan sukses
        return redirect()->route('members.index')->with('success', 'Member berhasil dihapus');
    }

   
}
