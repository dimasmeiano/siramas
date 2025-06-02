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
                <form class="needs-validation" novalidate method="POST" action="{{ route('organization_profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <!--begin::Body-->
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md">
                            <label for="nama_organisasi" class="form-label">Nama Organisasi</label>
                            <input
                            type="text"
                            class="form-control"
                            id="nama_organisasi"
                            name="nama_organisasi"
                            value="{{ old('nama_organisasi', $profile->nama_organisasi) }}"
                            placeholder="Masukkan Nama Organisasi"
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <span></span>
                        <div class="col-md">
                            <label for="visi" class="form-label">Visi Organisasi</label>
                            <textarea id="editor1" class="form-control @error('visi') is-invalid @enderror" name="visi" rows="20" cols="50">{{ old('visi', $profile->visi) }}</textarea>
                                @error('visi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                        <span></span>
                        <div class="col-md">
                            <label for="misi" class="form-label">Misi Organisasi</label>
                            <textarea id="editor2" class="form-control @error('misi') is-invalid @enderror" name="misi" rows="50" cols="100">{{ old('misi', $profile->misi) }}</textarea>
                            @error('misi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <span></span>
                        <div class="col-md">
                            <label for="alamat_sekretariat" class="form-label">Alamat Sekretariat</label>
                            <input
                            type="text"
                            class="form-control"
                            id="alamat_sekretariat"
                            name="alamat_sekretariat"
                            value="{{ old('alamat_sekretariat', $profile->alamat_sekretariat) }}"
                            placeholder="Masukkan Alamat Sekretariat"
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <span></span>
                        <div class="col-md">
                            <label for="no_hp" class="form-label">No. HP Sekretariatt</label>
                            <input
                            type="text"
                            class="form-control"
                            id="no_hp"
                            name="no_hp"
                            value="{{ old('no_hp', $profile->no_hp) }}"
                            placeholder="Masukkan No. Hp Sekretariat"
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <span></span>
                        <div class="col-md-6">
                            <label for="logo" class="form-label">Logo Organisasi</label>
                            <input name="logo" type="file" class="form-control" id="logo" value="{{ old('logo', $profile->logo) }}" />
                            @if ($profile->logo)
                                <div class="mt-2">
                                    <strong>Foto Lama:</strong><br>
                                    <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo Organisasi" style="max-width: 150px; border-radius: 8px;">
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="foto_masjid" class="form-label">Foto Masjid</label>
                            <input name="foto_masjid" type="file" class="form-control" id="foto_masjid" value="{{ old('foto_masjid', $profile->foto_masjid) }}" />
                            @if ($profile->foto_masjid)
                                <div class="mt-2">
                                    <strong>Foto Lama:</strong><br>
                                    <img src="{{ asset('storage/' . $profile->foto_masjid) }}" alt="Foto Masjid" style="max-width: 150px; border-radius: 8px;">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
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