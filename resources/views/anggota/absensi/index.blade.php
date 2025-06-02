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
                   <h2>Absensi Mandiri</h2>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if($kegiatanAktif->isEmpty())
                        <p>Tidak ada kegiatan aktif untuk diabsen saat ini.</p>
                    @else
                        <form method="POST" action="{{ route('anggota.absensi.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="kegiatan_id">Pilih Kegiatan</label>
                                <select name="kegiatan_id" id="kegiatan_id" class="form-control" required>
                                    <option value="">-- Pilih Kegiatan --</option>
                                    @foreach($kegiatanAktif as $kegiatan)
                                        <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama }} ({{ \Carbon\Carbon::parse($kegiatan->waktu_mulai)->format('d M Y H:i') }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mt-2">Absen Sekarang</button>
                        </form>
                    @endif
                  </div>
                  <!-- /.card-body -->
                   <div class="card-body">
                    <h4>Riwayat Absensi</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Kegiatan</th>
                                <th>Status</th>
                                <th>Waktu Absen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($absensis as $absen)
                                <tr>
                                    <td>{{ data_get($absen, 'kegiatan.waktu_mulai') ? \Carbon\Carbon::parse($absen->kegiatan->waktu_mulai)->format('d M Y') : '-' }}</td>
                                    <td>{{ $absen->kegiatan->nama }}</td>
                                    <td>{{ ucfirst($absen->status) }}</td>
                                    <td>{{ data_get($absen, 'waktu_absen') ? \Carbon\Carbon::parse($absen->waktu_absen)->format('d M Y') : '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data absensi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                   </div>
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