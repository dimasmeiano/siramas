@extends('layouts.admin.header')
@include('layouts.admin.sidebar')
@section('content')
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">{{ $title }}</h3></div>
              <div class="col-sm-6 text-end">
                    <a href="{{ route('buku_tamu.exportPdf') }}" class="btn btn-warning">Export PDF</a>
                    <a href="{{ route('buku_tamu.exportExcel') }}" class="btn btn-success">Export Excel</a>
                </div>
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
                    <form method="GET" class="form-control" action="{{ route('buku-tamu.index') }}">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="nama" placeholder="Cari nama..." value="{{ request('nama') }}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="instansi" placeholder="Cari Instansi..." value="{{ request('instansi') }}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="kontak" placeholder="Cari Kontak..." value="{{ request('kontak') }}">
                            </div>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
                            </div>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Cari / Filter</button>
                    </form>
                    <table class="table table-bordered" border="1" cellpadding="5" cellspacing="0">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Nama Lengkap</th>
                          <th>Instansi</th>
                          <th>Kontak</th>
                          <th>Keperluan</th>
                          <th>Waktu Kunjungan</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $no = 1; @endphp
                        @foreach($tamus as $tamu)
                        <tr class="align-middle">
                          <td>{{ $no++ }}</td>
                          <td>{{ $tamu->nama }}</td>
                          <td>{{ $tamu->instansi }}</td>
                          <td>{{ $tamu->kontak }}</td>
                          <td>{{ $tamu->keperluan }}</td>
                          <td>{{ \Carbon\Carbon::parse($tamu->tanggal_kunjungan)->format('d-m-Y H:i') }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-end">
                      {{ $tamus->links() }}
                    </ul>
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
@extends('layouts.admin.footer')