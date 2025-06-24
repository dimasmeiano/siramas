@extends('layouts.anggota.header')
@include('layouts.anggota.sidebar')
@section('content')
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
        
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-md">
                <div class="card mb-4">
                  <div class="card-body">
                   <div class="max-w-7xl mx-auto px-4 py-6">
                      <div class="flex justify-between items-center mb-6">
                          <div>
                              <h1 class="text-2xl font-bold">Halo, {{ Auth::user()->member->nama_lengkap }}</h1>
                              <p class="text-sm text-gray-500">Selamat datang di sistem manajemen Remaja Masjid</p>
                          </div>
                      </div>
                      {{-- Quick Menu Grid --}}
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-6">

                        {{-- Statistik Ringkas --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-white p-4 rounded-xl shadow">
                                <h2 class="font-semibold text-gray-800 mb-2">Kehadiran Hari Ini</h2>
                                <p class="text-2xl font-bold {{ $checkinToday ? 'text-green-600' : 'text-red-500' }}">
                                    {{ $checkinToday ? 'Hadir' : 'Belum Check-in' }}
                                </p>
                            </div>
                            <div class="bg-white p-4 rounded-xl shadow">
                                <h2 class="font-semibold text-gray-800 mb-2">Sisa Cuti</h2>
                                <p class="text-2xl font-bold text-blue-600">{{ $sisaCuti }} Hari</p>
                            </div>
                            <div class="bg-white p-4 rounded-xl shadow">
                                <h2 class="font-semibold text-gray-800 mb-2">Tugas Aktif</h2>
                                <p class="text-2xl font-bold text-yellow-600">{{ $tugasAktif }} Tugas</p>
                            </div>
                        </div>

                        {{-- Pengumuman --}}
                        <div class="mt-8">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Pengumuman Terbaru</h2>
                            <div class="bg-white p-4 rounded-xl shadow">
                                @forelse($pengumuman as $item)
                                    <div class="mb-3 border-b pb-2">
                                        <div class="font-bold">{{ is_callable($item->judul) ? $item->judul() : $item->judul }}</div>
                                        <div class="text-sm text-gray-600">{{ $item->tanggal_mulai->format('d M Y') }} - {{ $item->tanggal_selesai->format('d M Y') }}</div>
                                        <div class="text-sm text-gray-800 mt-1">{{ Str::limit($item->konten, 100) }}</div>
                                    </div>
                                @empty
                                    <p class="text-gray-500 text-sm">Belum ada pengumuman.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
@extends('layouts.anggota.footer')