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
                <form class="needs-validation" novalidate method="POST" action="{{ route('sosial-media.store') }}" enctype="multipart/form-data">
                    @csrf
                <!--begin::Body-->
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama Sosial Media</label>
                            <input
                            type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            placeholder="Masukkan Nama Sosial Media"
                            required
                            />
                        </div>
                        <div class="col-md-6">
                            <label for="url" class="form-label">URL</label>
                            <input
                            type="text"
                            class="form-control"
                            id="url"
                            name="url"
                            placeholder="Masukkan URL Sosial Media"
                            required
                            />
                        </div>
                        <div class="col-md-6">
                            <label for="icon" class="form-label">Icon</label>
                            <input
                            type="text"
                            class="form-control"
                            id="icon"
                            name="icon"
                            placeholder="Masukkan Nama Sosial Media"
                            required
                            />
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
     