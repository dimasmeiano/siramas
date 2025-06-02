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
            <div class="col-sm-6"><h3 class="mb-0">Tambah Foto Galeri untuk Program: {{ $program->nama }}</h3></div>
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
                <form class="needs-validation" novalidate method="POST" action="{{ route('program_galeri.update', [$program->id, $foto->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <!--begin::Body-->
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md">
                            <label for="file" class="form-label">Foto Saat Ini</label>
                            <img src="{{ asset('storage/' . $foto->photo_path) }}" alt="Foto" width="300">
                        </div>
                        <div class="col-md">
                            <label for="file" class="form-label">Ganti Foto ( Opsional )</label>
                            <input name="photos[]" type="file" class="form-control" id="file" value="{{ old('photos', $foto->photo_path) }}" />
                        </div>
                        <span></span>
                        <div class="col-md">
                            <label for="caption" class="form-label">Caption ( Opsional )</label>
                            <input
                            type="text"
                            class="form-control"
                            id="caption"
                            name="caption"
                            value="{{ old('caption', $foto->caption) }}"
                            placeholder="Masukkan Caption "
                            />
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
