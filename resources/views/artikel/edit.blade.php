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
                <form class="needs-validation" novalidate method="POST" action="{{ route('artikel.update', $artikel->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <!--begin::Body-->
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md">
                            <label for="judul" class="form-label">Judul Berita</label>
                            <input
                            type="text"
                            class="form-control"
                            id="judul"
                            name="judul"
                            value="{{ old('judul', $artikel->judul) }}"
                            required
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <span></span>
                        <div class="col-md">
                            <label for="isi" class="form-label">Isi Berita</label>
                            <textarea
                            class="form-control"
                            id="isi"
                            name="isi"
                            required
                            >{{ old('isi', $artikel->isi) }}</textarea>
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <span></span>
                        <div class="col-md">
                            <label for="thumbnail" class="form-label">Thumbnail</label>
                            <input name="thumbnail" value="{{ old('thumbnail', $artikel->thumbnail) }}" type="file" class="form-control" id="thumbnail" />
                        </div>
                        <span></span>
                        <div class="col-md">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option disabled value="">Pilih Status</option>
                                <option value="draft" {{ $artikel->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="publish" {{ $artikel->status == 'publish' ? 'selected' : '' }}>Publish</option>
                            </select>
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <span></span>
                        <div class="col-md">
                            <label for="kategori_id" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori_id" name="kategori_id" required>
                                <option disabled value="">Pilih Kategori</option>
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}" {{ $artikel->kategori_id == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
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
     