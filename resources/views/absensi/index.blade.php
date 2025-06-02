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
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Nama Anggota</th>
                          <th>Nama Kegiatan</th>
                          <th>Tanggal Kegiatan</th>
                          <th>Waktu Absen</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $no = 1; @endphp
                        @foreach($absensis as $item)
                        <tr class="align-middle">
                          <td>{{ $no++ }}</td>
                          <td>{{ $item->anggota->nama_lengkap }}</td>
                          <td>{{ $item->kegiatan->nama }}</td>
                          <td>{{ \Carbon\Carbon::parse($item->kegiatan->waktu_mulai)->format('d M Y H:i') }}</td>
                          <td>{{ \Carbon\Carbon::parse($item->waktu_absen)->format('d M Y H:i') }}</td>
                          <td>{{ ucfirst($item->status) }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-end">
                      {{ $absensis->links() }}
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