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
                <form class="needs-validation" novalidate method="POST" action="{{ route('members.update', $member->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <!--begin::Body-->
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input
                            type="text"
                            class="form-control"
                            id="nama_lengkap"
                            name="nama_lengkap"
                            value="{{ old('nama_lengkap', $member->nama_lengkap) }}"
                            placeholder="Masukkan Nama Lengkap"
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input
                            type="text"
                            class="form-control"
                            id="tempat_lahir"
                            name="tempat_lahir"
                            value="{{ old('tempat_lahir', $member->tempat_lahir) }}"
                            placeholder="Masukkan Tempat Lahir"
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input
                            type="date"
                            class="form-control"
                            id="tanggal_lahir"
                            name="tanggal_lahir"
                            value="{{ old('tanggal_lahir', $member->tanggal_lahir) }}"
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="jenis_kelamin" id="jenis_kelamin" required>
                                <option disabled>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $member->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki - Laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $member->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="no_hp" class="form-label">No. Telp/HP</label>
                            <input
                            type="text"
                            class="form-control"
                            id="no_hp"
                            name="no_hp"
                            value="{{ old('no_hp', $member->no_hp) }}"
                            placeholder="Masukkan No. Telp/HP"
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">E - Mail</label>
                            <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            value="{{ old('email', $member->email) }}"
                            placeholder="Masukkan E - Mail | Contoh : user@gmail.com"
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input
                            type="text"
                            class="form-control"
                            id="alamat"
                            name="alamat"
                            value="{{ old('nama_lengkap', $member->alamat) }}"
                            placeholder="Masukkan Alamat | Contoh : RT. 003 RW. 004"
                            required
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                            <select class="form-select" name="pendidikan_terakhir" id="pendidikan_terakhir">  
                            <option>Pilih Pendidikan Terakhir</option>
                                <option value="SD/MI" {{ old('pendidikan_terakhir', $member->pendidikan_terakhir) == 'SD/MI' ? 'selected' : '' }}>SD/MI</option>
                                <option value="SMP/MTs" {{ old('pendidikan_terakhir', $member->pendidikan_terakhir) == 'SMP/MTs' ? 'selected' : '' }}>SMP/MTs</option>
                                <option value="SMA/MA/SMK/MAK" {{ old('pendidikan_terakhir', $member->pendidikan_terakhir) == 'SMA/MA/SMK/MAK' ? 'selected' : '' }}>SMA/MA/SMK/MAK</option>
                                <option value="S1" {{ old('pendidikan_terakhir', $member->pendidikan_terakhir) == 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="S2" {{ old('pendidikan_terakhir', $member->pendidikan_terakhir) == 'S2' ? 'selected' : '' }}>S2</option>
                            </select>
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="foto" class="form-label">Foto Anggota</label>
                            <input name="foto" type="file" class="form-control" id="foto" value="{{ old('foto', $member->foto) }}" />
                            @if ($member->foto)
                                <div class="mt-2">
                                    <strong>Foto Lama:</strong><br>
                                    <img src="{{ asset('storage/' . $member->foto) }}" alt="Foto Anggota" style="max-width: 150px; border-radius: 8px;">
                                </div>
                            @endif
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