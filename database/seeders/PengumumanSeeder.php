<?php

namespace Database\Seeders;

use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first(); // pakai user pertama sebagai pembuat

        Pengumuman::create([
            'judul' => 'Kajian Rutin Malam Jumat',
            'konten' => 'Kajian rutin setiap malam Jumat pukul 19.30 WIB di masjid.',
            'dibuat_oleh' => $user->id,
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addDays(7),
        ]);

        Pengumuman::create([
            'judul' => 'Kerja Bakti',
            'konten' => 'Kerja bakti lingkungan sekitar masjid hari Minggu.',
            'dibuat_oleh' => $user->id,
            'tanggal_mulai' => now()->addDays(2),
            'tanggal_selesai' => now()->addDays(3),
        ]);
    }
}
