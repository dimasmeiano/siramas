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
                <form class="needs-validation" novalidate method="POST" action="{{ route('program-kerja.update', $programKerja->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                            value="{{ old('nama', $programKerja->nama) }}"
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
                            >{{ old('deskripsi', $programKerja->deskripsi) }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="pics" class="form-label">Penanggung Jawab</label>
                            <select class="form-select" name="pics[]" id="pics" required>
                                <option disabled>Pilih Anggota</option>
                                @foreach ($members as $user)
                                    <option value="{{ $user->id }}" {{ $programKerja->pics->contains($user->id) ? 'selected' : '' }}>
                                        {{ $user->nama_lengkap }}
                                    </option>
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
                            value="{{ old('tanggal_mulai', $programKerja->tanggal_mulai) }}"
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
                            value="{{ old('tanggal_selesai', $programKerja->tanggal_selesai) }}"
                            required
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status" required>
                                <option disabled>Pilih Status</option>
                                 <option value="Yang Harus Dilakukan" {{ old('status', $programKerja->status) == 'Yang Harus Dilakukan' ? 'selected' : '' }}>Yang Harus Dilakukan</option>
                                 <option value="Dalam Proses" {{ old('status', $programKerja->status) == 'Dalam Proses' ? 'selected' : '' }}>Dalam Proses</option>
                                 <option value="Revisi" {{ old('status', $programKerja->status) == 'Revisi' ? 'selected' : '' }}>Revisi</option>
                                 <option value="Selesai" {{ old('status', $programKerja->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
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
     