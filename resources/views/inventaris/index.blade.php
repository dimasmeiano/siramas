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
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
              <div class="col-sm-6"><h3 class="mb-0">{{ $title }}</h3></div>
              <div class="col-sm-6 text-end">
                    <a href="{{ route('inventaris.create') }}" class="btn btn-primary w-20">
                        <i class="bi bi-person-plus-fill"></i>&nbsp; Tambah Daftar Inventaris
                    </a>
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
                    <form method="GET" class="form-control" action="{{ route('inventaris.index') }}">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="nama_barang" placeholder="Cari nama..." value="{{ request('nama_barang') }}">
                        </div>
                      <button type="submit" class="btn btn-primary">Cari / Filter</button>
                    </form>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Nama Barang</th>
                          <th>Deskripsi</th>
                          <th>Jumlah</th>
                          <th>Lokasi</th>
                          <th>Tanggal Perolehan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $no = 1; @endphp
                        @foreach($inventaris as $item)
                        <tr class="align-middle">
                          <td>{{ $no++ }}</td>
                          <td>{{ $item->nama_barang }}</td>
                          <td>{{ $item->deskripsi }}</td>
                          <td>{{ $item->jumlah }}</td>
                          <td>{{ $item->lokasi }}</td>
                          <td>{{ $item->tanggal_perolehan }}</td>
                          <td>
                                <a href="{{ route('inventaris.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></i></a>
                                <a href="#" class="btn btn-sm btn-danger" onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                    <i class="bi bi-trash-fill"></i>
                                </a>

                                <form id="delete-form-{{ $item->id }}" action="{{ route('inventaris.destroy', $item->id) }}" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-end">
                      {{ $inventaris->links() }}
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