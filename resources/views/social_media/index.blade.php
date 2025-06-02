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
        <div class="col-sm-6"><h3 class="mb-0">{{ $title }}</h3></div>
        <div class="col-sm-6 text-end">
            <a href="{{ route('sosial-media.create') }}" class="btn btn-primary w-20">
                <i class="bi bi-person-plus-fill"></i>&nbsp; Tambah Sosial Media
            </a>
        </div>
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
    <div class="row">
        <div class="col-md">
        <div class="card mb-4">
            <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama</th>
                    <th>Tautan URL</th>
                    <th>Icon</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php $no = 1; @endphp
                @foreach($items as $item)
                <tr class="align-middle">
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->name }}</td>
                    <td><a href="{{ $item->url }}" target="_blank">{{ $item->url }}</a></td>
                    <td><i class="{{ $item->icon }}"></i></td>
                    <td>
                        <a href="{{ route('sosial-media.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></i></a>
                        <a href="#" class="btn btn-sm btn-danger" onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                            <i class="bi bi-trash-fill"></i>
                        </a>

                        <form id="delete-form-{{ $item->id }}" action="{{ route('sosial-media.destroy', $item->id) }}" method="POST" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<!--end::App Content-->
</main>
<!--end::App Main-->
@extends('layouts.admin.footer')