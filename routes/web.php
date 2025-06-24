<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\Anggota\AbsensiController as AnggotaAbsensiController;
use App\Http\Controllers\Anggota\DashboardController as AnggotaDashboardController;
use App\Http\Controllers\Anggota\PengumumanAnggotaController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrganizationProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\ProgramKerjaController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\LpjController;
use App\Http\Controllers\KategoriBeritaController;
use App\Http\Controllers\ArtikelBeritaController;
use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardKesekretariatanController;
use App\Http\Controllers\Frontend\BeritaController;
use App\Http\Controllers\frontend\BukuTamuController as FrontendBukuTamuController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\MarqueeController;
use App\Http\Controllers\NotulenController;
use App\Http\Controllers\ProgramGaleriController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('frontend.welcome');
});
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/tamu', [FrontendBukuTamuController::class, 'index'])->name('tamu.index');
Route::post('/tamu', [FrontendBukuTamuController::class, 'store'])->name('tamu.store');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware(['guest'])
    ->name('login');
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('members', MemberController::class);
    Route::get('/organization-profile', [OrganizationProfileController::class, 'edit'])->name('organization_profile.edit');
    Route::put('/organization-profile', [OrganizationProfileController::class, 'update'])->name('organization_profile.update');
    Route::resource('pengurus', PengurusController::class);
    Route::resource('program-kerja', ProgramKerjaController::class);
    Route::resource('lpj', LpjController::class);
    Route::resource('keuangan', KeuanganController::class);
    Route::resource('kategori', KategoriBeritaController::class);
    Route::resource('artikel', ArtikelBeritaController::class);
    Route::resource('comment', CommentController::class);
    Route::resource('sosial-media', SocialMediaController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('visitor', VisitorController::class);
    Route::resource('kegiatan', KegiatanController::class);
    Route::resource('absensi', AbsensiController::class);
    Route::resource('notulen', NotulenController::class);
    Route::resource('inventaris', InventarisController::class);
    Route::resource('buku-tamu', BukuTamuController::class);
    Route::resource('dashboard-kesekretariatan', DashboardKesekretariatanController::class);
    // Route Galeri Secara Terpisah
    Route::get('/program/{programId}/galeri', [ProgramGaleriController::class, 'index'])->name('program_galeri.index');
    Route::get('/program/{programId}/galeri/create', [ProgramGaleriController::class, 'create'])->name('program_galeri.create');
    Route::post('/program/{programId}/galeri', [ProgramGaleriController::class, 'store'])->name('program_galeri.store');
    Route::get('/program/{programId}/galeri/{id}/edit', [ProgramGaleriController::class, 'edit'])->name('program_galeri.edit');
    Route::put('/program/{programId}/galeri/{id}', [ProgramGaleriController::class, 'update'])->name('program_galeri.update');
    Route::delete('/program/{programId}/galeri/{id}', [ProgramGaleriController::class, 'destroy'])->name('program_galeri.destroy');
    Route::post('program/{programId}/galeri/reorder', [ProgramGaleriController::class, 'reorder'])->name('program_galeri.reorder');
    // Route Marque ( Teks Berjalan )
    Route::get('/marquee', [MarqueeController::class, 'index'])->name('marquee.index');
    Route::put('/marquee', [MarqueeController::class, 'update'])->name('marquee.update');
    Route::post('/sliders/{id}/toggle-status', [SliderController::class, 'toggleStatus']);
    Route::get('/laporan-absensi/{kegiatan}', [AbsensiController::class, 'laporan']);
    // Download file
    Route::get('program-kerja/download/{id}', [ProgramKerjaController::class, 'downloadFile'])->name('program-kerja.download');
    // duplicate program kerja
    Route::post('program-kerja/duplicate/{id}', [ProgramKerjaController::class, 'duplicate'])->name('program-kerja.duplicate');
    // Export routes
    Route::get('keuangan-export-pdf', [KeuanganController::class, 'exportPdf'])->name('keuangan.exportPdf');
    Route::get('keuangan-export-excel', [KeuanganController::class, 'exportExcel'])->name('keuangan.exportExcel');
    Route::get('/lpj/{id}/export/pdf', [LpjController::class, 'exportPdf'])->name('lpj.exportPdf');
    // filter tabel visitor
    Route::get('/visitors/filter/{type}', [VisitorController::class, 'filter'])->name('visitors.filter');
    // download PDF Notulen
    Route::get('notulen/{notulen}/pdf', [NotulenController::class, 'downloadPDF'])->name('notulen.downloadPDF');
    Route::get('/buku-tamu-export-excel', [BukuTamuController::class, 'exportExcel'])->name('buku_tamu.exportExcel');
    Route::get('/buku-tamu-export-pdf', [BukuTamuController::class, 'exportPdf'])->name('buku_tamu.exportPdf');
});

Route::middleware(['auth', 'role:anggota'])->group(function () {
    Route::get('/anggota/dashboard', [AnggotaDashboardController::class, 'index'])->name('anggota.dashboard');
    Route::get('/anggota/absensi', [AnggotaAbsensiController::class, 'index'])->name('anggota.absensi.index');
    Route::post('/anggota/absensi', [AnggotaAbsensiController::class, 'store'])->name('anggota.absensi.store');
    Route::resource('anggota/pengumuman', PengumumanAnggotaController::class)->names([
        'index' => 'anggota.pengumuman.index',
    ]);
});
Route::get('/phpinfo', function () {
    phpinfo();
})->name('phpinfo');
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');