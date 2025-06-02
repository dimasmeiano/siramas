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
                <form class="needs-validation" novalidate method="POST" action="{{ route('notulen.store') }}" enctype="multipart/form-data">
                    @csrf
                <!--begin::Body-->
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md">
                            <label for="kegiatan_id" class="form-label">Nama Kegiatan</label>
                            <select class="form-select" id="kegiatan_id" name="kegiatan_id" required>
                                <option value="">Pilih Kegiatan</option>
                                @foreach ($kegiatans as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md">
                            <label for="pemimpin_id" class="form-label">Nama Pemimpin Rapat</label>
                            <select class="form-select" id="pemimpin_id" name="pemimpin_id" required>
                                <option value="">Pilih Pemimpin Rapat</option>
                                @foreach ($members as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <span></span>
                        <div class="col-md">
                            <label for="isi_notulen" class="form-label">Isi Notulen</label>
                            <textarea
                            class="form-control"
                            id="isi_notulen"
                            name="isi_notulen"
                            required
                            ></textarea>
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <span></span>
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
     