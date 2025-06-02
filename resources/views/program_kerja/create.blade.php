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
            <div class="col-sm-6"><h3 class="mb-0">{{$title}}</h3></div>
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
        <div class="row g-4">
            <!--begin::Col-->
            <div class="col-md">
            <!--begin::Quick Example-->
            <div class="card card-primary card-outline mb-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!--begin::Form-->
                <form class="needs-validation" novalidate method="POST" action="{{ route('program-kerja.store') }}" enctype="multipart/form-data">
                    @csrf
                <!--begin::Body-->
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama Program Kerja</label>
                            <input
                            type="text"
                            class="form-control"
                            id="nama"
                            name="nama"
                            placeholder="Masukkan Nama Program Kerja"
                            required
                            />
                        </div>
                        <div class="col-md-6">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea
                            class="form-control"
                            id="deskripsi"
                            name="deskripsi"
                            rows="3"
                            placeholder="Masukkan Deskripsi Program Kerja"
                            required
                            ></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="pics" class="form-label">Penanggung Jawab</label>
                            <select class="form-select" name="pics[]" id="pics" required>
                                <option>Pilih Anggota</option>
                                @foreach ($members as $user)
                                <option value="{{ $user->id }}">{{ $user->nama_lengkap }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                            <input
                            type="date"
                            class="form-control"
                            id="tanggal_mulai"
                            name="tanggal_mulai"
                            required
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                            <input
                            type="date"
                            class="form-control"
                            id="tanggal_selesai"
                            name="tanggal_selesai"
                            required
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status" required>
                                <option>Pilih Status</option>
                                 <option value="Yang Harus Dilakukan">Yang Harus Dilakukan</option>
                                <option value="Dalam Proses">Dalam Proses</option>
                                <option value="Revisi">Revisi</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="interval" class="form-label">Interval</label>
                            <select class="form-select" name="interval" id="interval" required>
                                <option>Pilih Status</option>
                                <option value="weekly">Mingguan</option>
                                <option value="monthly">Bulanan</option>
                                
                            </select>
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">                          
                            <input class="form-check-input" type="checkbox" name="is_template" id="is_template" value="1" {{ old('auto_generate') ? 'checked' : '' }}>
                            <label class="form-check-label" for="auto_generate">
                                Aktifkan Auto Generate Program Kerja dari Template
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label for="file" class="form-label">File</label>
                            <input name="file" type="file" class="form-control" id="file" />
                        </div>
                    </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <!--end::Footer-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Quick Example-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
    </main>
      <!--end::App Main-->

@extends('layouts.admin.footer')
     