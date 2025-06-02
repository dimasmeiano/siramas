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
                    <a href="{{ route('members.create') }}" class="btn btn-primary w-20">
                        <i class="bi bi-person-plus-fill"></i>&nbsp; Tambah Anggota
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
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Nama Program</th>
                          <th>Deskripsi</th>
                          <th>Tanggal Mulai</th>
                          <th>Tanggal Selesai</th>
                          <th>Status</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $no = 1; @endphp
                        @foreach($programs as $program)
                        <tr class="align-middle">
                          <td>{{ $no++ }}</td>
                          <td>{{ $program->nama }}</td>
                          <td>{{ $program->deskripsi }}</td>
                          <td>{{ $program->tanggal_mulai }}</td>
                          <td>{{ $program->tanggal_selesai }}</td>
                          <td>{{ $program->status }}</td>
                          <td>
                                <a href="{{ route('program-kerja.edit', $program->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></i></a>
                                <a href="#" class="btn btn-sm btn-danger" onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus?')) { document.getElementById('delete-form-{{ $program->id }}').submit(); }">
                                    <i class="bi bi-trash-fill"></i>
                                </a>

                                <form id="delete-form-{{ $program->id }}" action="{{ route('program-kerja.destroy', $program->id) }}" method="POST" style="display:none;">
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