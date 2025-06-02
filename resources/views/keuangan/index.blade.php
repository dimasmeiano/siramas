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
                    <a href="{{ route('keuangan.create') }}" class="btn btn-primary w-20">
                        <i class="bi bi-person-plus-fill"></i>&nbsp; Tambah Keuangan
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
                    <form action="{{ route('keuangan.index') }}" method="GET" class="row g-3 mb-3">
                        <div class="col-md-4">
                            <select name="program_kerja_id" class="form-select" onchange="this.form.submit()">
                                <option value="">-- Semua Program Kerja --</option>
                                @foreach($programKerjaList as $program)
                                    <option value="{{ $program->id }}" {{ request('program_kerja_id') == $program->id ? 'selected' : '' }}>{{ $program->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="periode" class="form-select" onchange="this.form.submit()">
                                <option value="">-- Semua Periode --</option>
                                <option value="mingguan" {{ request('periode') == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                                <option value="bulanan" {{ request('periode') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                                <option value="tahunan" {{ request('periode') == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                            </select>
                        </div>
                    </form>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Program Kerja</th>
                                <th>Jenis</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($keuangan as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                    <td>{{ $item->programKerja->nama ?? 'Umum' }}</td>
                                    <td>{{ ucfirst($item->jenis) }}</td>
                                    <td>Rp {{ number_format($item->nominal, 2, ',', '.') }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                      <a href="{{ route('keuangan.show', $item->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye-fill"></i></a>
                                      <a href="{{ route('keuangan.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></i></a>
                                      <a href="#" class="btn btn-sm btn-danger" onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                          <i class="bi bi-trash-fill"></i>
                                      </a>

                                      <form id="delete-form-{{ $item->id }}" action="{{ route('keuangan.destroy', $item->id) }}" method="POST" style="display:none;">
                                          @csrf
                                          @method('DELETE')
                                      </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-end">
                      {{ $keuangan->links() }}
                    </ul>
                  </div>
                  <span></span>
                    <a href="{{ route('keuangan.exportPdf', request()->all()) }}" class="btn btn-danger">Export PDF</a>
                    <a href="{{ route('keuangan.exportExcel', request()->all()) }}" class="btn btn-success">Export Excel</a>
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