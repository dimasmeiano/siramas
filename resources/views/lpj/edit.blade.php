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
                <form class="needs-validation" novalidate method="POST" action="{{ route('lpj.update', $lpj->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <!--begin::Body-->
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                            <input
                            type="text"
                            class="form-control"
                            id="nama_kegiatan"
                            name="nama_kegiatan"
                            placeholder="Masukkan Nama Kegiatan"
                            value="{{ old('nama_kegiatan', $lpj->nama_kegiatan) }}"
                            required
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_pelaksanaan" class="form-label">Tanggal Pelaksanaan</label>
                            <input
                            type="date"
                            class="form-control"
                            id="tanggal_pelaksanaan"
                            name="tanggal_pelaksanaan"
                            value="{{ old('tanggal_pelaksanaan', $lpj->tanggal_pelaksanaan) }}"
                            required
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="ketua_pelaksana_id" class="form-label">Penanggungjawab</label>
                            <select class="form-select" name="ketua_pelaksana_id" id="ketua_pelaksana_id" required>
                                <option disabled>Pilih PenanggungJawab</option>
                                @foreach ($members as $item)
                                    <option value="{{ $item->id }}" 
                                        {{ old('ketua_pelaksana_id', $lpj->ketua_pelaksana_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_lengkap }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="program_kerja_id" class="form-label">Program Kerja</label>
                            <select class="form-select" name="program_kerja_id" id="program_kerja_id" required>
                                <option>Pilih Program Kerja</option>
                                @foreach ($programKerjas as $item)
                                    <option value="{{ $item->id }}" 
                                        {{ old('program_kerja_id', $lpj->program_kerja_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="anggaran_dana" class="form-label">Anggaran Dana</label>
                            <input
                            type="number"
                            class="form-control"
                            id="anggaran_dana"
                            name="anggaran_dana"
                            value="{{ old('anggaran_dana', $lpj->anggaran_dana) }}"
                            placeholder="Masukkan Anggaran Dana | Contoh : 1000000"
                            required
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="dana_terealisasi" class="form-label">Anggaran Terealisasi</label>
                            <input
                            type="number"
                            class="form-control"
                            id="dana_terealisasi"
                            name="dana_terealisasi"
                            value="{{ old('dana_terealisasi', $lpj->dana_terealisasi) }}"
                            placeholder="Masukkan Anggaran Terealisasi | Contoh : 1000000"
                            required
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="ringkasan" class="form-label">Ringkasan Kegiatan</label>
                            <input
                            type="text"
                            class="form-control"
                            id="ringkasan"
                            name="ringkasan"
                            value="{{ old('ringkasan', $lpj->ringkasan) }}"
                            placeholder="Masukkan Ringkasan Kegiatan"
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="dokumentasi" class="form-label">Dokumentasi</label>
                            <input name="dokumentasi[]" type="file" class="form-control" value="{{ old('dokumentasi', $lpj->dokumentasi) }}" id="dokumentasi" multiple/>
                        </div>
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