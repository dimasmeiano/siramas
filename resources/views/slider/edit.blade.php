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
                <form class="needs-validation" novalidate method="POST" action="{{ route('slider.update', $slider->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <!--begin::Body-->
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="title" class="form-label">Judul</label>
                            <input
                            type="text"
                            class="form-control"
                            id="title"
                            name="title"
                            value="{{ old('title', $slider->title) }}"
                            placeholder="Masukkan Judul Slider"
                            required
                            />
                        </div>
                        <div class="col-md-6">
                            <label for="subtitle" class="form-label">Subtitle ( Opsional )</label>
                            <input
                            type="text"
                            class="form-control"
                            id="subtitle"
                            name="subtitle"
                            value="{{ old('subtitle', $slider->subtitle) }}"
                            placeholder="Masukkan Subtitle Slider"
                            />
                        </div>
                        <div class="col-md-6">
                            <label for="description" class="form-label">Deskripsi ( Opsional )</label>
                            <textarea
                            class="form-control"
                            id="description"
                            name="description"
                            placeholder="Masukkan Deskripsi Slider"
                            rows="3">{{ old('description', $slider->description) }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="image" class="form-label">Gambar</label>
                            <input name="image" type="file" class="form-control" value="{{ old('image', $slider->image) }}" id="image"/>
                        </div>
                        <div class="col-md-6">
                            <label for="link" class="form-label">Tautan ( Opsional )</label>
                            <input
                            type="text"
                            class="form-control"
                            id="link"
                            name="link"
                            value="{{ old('link', $slider->link) }}"
                            placeholder="Masukkan Link Slider"
                            />
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
     