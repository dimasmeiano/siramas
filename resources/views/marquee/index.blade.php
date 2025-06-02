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
                <form class="needs-validation" novalidate method="POST" action="{{ route('marquee.update') }}">
                    @csrf
                    @method('PUT')
                <!--begin::Body-->
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="text" class="form-label">Teks</label>
                            <input
                            type="text"
                            class="form-control"
                            id="text"
                            name="text"
                            value="{{ old('text', $marquee->text ?? '') }}"
                            placeholder="Masukkan Teks Berjalan"
                            required
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="text" class="form-label">Arah Pergerakan</label>
                            <select name="direction" class="form-select">
                                <option value="left" {{ old('direction', $marquee->direction ?? '') == 'left' ? 'selected' : '' }}>Kiri</option>
                                <option value="right" {{ old('direction', $marquee->direction ?? '') == 'right' ? 'selected' : '' }}>Kanan</option>
                                <option value="up" {{ old('direction' , $marquee->direction ?? '') == 'up' ? 'selected' : '' }}>Atas</option>
                                <option value="down" {{ old('direction', $marquee->direction ?? '') == 'down' ? 'selected' : '' }}>Bawah</option>
                            </select>
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                         <div class="col-md-6">
                            <label for="speed" class="form-label">Kecepatan</label>
                            <input
                            type="number"
                            class="form-control"
                            id="speed"
                            name="speed"
                            value="{{ old('speed', $marquee->speed ?? '') }}"
                            placeholder="Masukkan Teks Berjalan"
                            required
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                         <div class="col-md-6">
                             <input
                             type="checkbox"
                             class="checkbox"
                             id="is_active"
                             name="is_active"
                             value="1"
                             {{ old('is_active', $marquee->is_active ?? false) ? 'checked' : '' }}
                             />
                             <label for="is_active" class="form-label">Aktifkan/Nonaktifkan Teks</label>
                             <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
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