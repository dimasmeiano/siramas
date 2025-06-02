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
                <form class="needs-validation" novalidate method="POST" action="{{ route('inventaris.update', $inventari->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <!--begin::Body-->
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input
                            type="text"
                            class="form-control"
                            id="nama_barang"
                            name="nama_barang"
                            placeholder="Masukkan Nama Barang"
                            value="{{ old('nama_barang', $inventari->nama_barang) }}"
                            required
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input
                            type="text"
                            class="form-control"
                            id="deskripsi"
                            name="deskripsi"
                            placeholder="Masukkan Deskripsi"
                            value="{{ old('deskripsi', $inventari->deskripsi) }}"
                            required
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="jumlah" class="form-label">Jumlah Barang</label>
                            <input
                            type="number"
                            class="form-control"
                            id="jumlah"
                            name="jumlah"
                            placeholder="Masukkan Jumlah Barang"
                            value="{{ old('jumlah', $inventari->jumlah) }}"
                            required
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="" disabled>Pilih Status</option>
                                <option value="Baik"  {{ old('status', $inventari->status) == 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Rusak" {{ old('status', $inventari->status) == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                                <option value="Dipinjam" {{ old('status', $inventari->status) == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="Hilang" {{ old('status', $inventari->status) == 'Hilang' ? 'selected' : '' }}>Hilang</option>
                            </select>
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="lokasi" class="form-label">Lokasi </label>
                            <input
                            type="text"
                            class="form-control"
                            id="lokasi"
                            name="lokasi"
                            placeholder="Masukkan Lokasi "
                            value="{{ old('lokasi', $inventari->lokasi) }}"
                            required
                            />
                            <div class="invalid-feedback">Mohon diisi dengan benar !!!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_perolehan" class="form-label">Tanggal Perolehan</label>
                            <input
                            type="date"
                            class="form-control"
                            id="tanggal_perolehan"
                            name="tanggal_perolehan"
                            value="{{ old('tanggal_perolehan', $inventari->tanggal_perolehan? $inventari->tanggal_perolehan : '') }}"
                            required
                            />
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