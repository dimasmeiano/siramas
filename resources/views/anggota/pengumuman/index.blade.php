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
                    <h1 class="text-2xl font-bold mb-4">{{ $title }}</h1>

                    <div class="bg-white p-4 rounded-xl shadow">
                        @forelse($pengumuman as $item)
                            <div class="mb-4 border-b pb-3">
                                <div class="font-bold text-lg text-gray-800">{{ $item->judul }}</div>
                                <div class="text-sm text-gray-500">{{ $item->tanggal_mulai->format('d M Y') }} - {{ $item->tanggal_selesai->format('d M Y') }}</div>
                                <div class="text-sm text-gray-700 mt-2">{{ $item->konten }}</div>
                            </div>
                        @empty
                            <p class="text-gray-500">Belum ada pengumuman saat ini.</p>
                        @endforelse
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