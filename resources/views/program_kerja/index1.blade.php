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
                    <a href="{{ route('program-kerja.create') }}" class="btn btn-primary w-20">
                        <i class="bi bi-person-plus-fill"></i>&nbsp; Tambah Program Kerja
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
                @php
                    $statuses = ['Yang Harus Dilakukan', 'Dalam Proses', 'Revisi', 'Selesai'];
                    $colors = ['secondary', 'primary', 'warning', 'success'];
                @endphp

              @foreach($statuses as $index => $status)
              <div class="col-md-3">
                  <div class="card border-{{ $colors[$index] }}">
                      <div class="card-header bg-{{ $colors[$index] }} text-white">
                          {{ $status }}
                      </div>
                      <div class="card-body" style="min-height: 300px;">
                          @foreach ($programs->where('status', $status) as $program)
                              <div class="card mb-2">
                                  <div class="card-body">
                                      <h6>{{ $program->nama }}</h6>
                                      <small>{{ $program->tanggal_mulai }} s.d. {{ $program->tanggal_selesai }}</small>
                                      <div class="mt-2">
                                          <a href="{{ route('program-kerja.edit', $program->id) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                          <form action="{{ route('program-kerja.duplicate', $program->id) }}" method="POST" style="display:inline;">
                                              @csrf
                                              <button type="submit" class="btn btn-sm btn-outline-secondary">Duplikat</button>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                          @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
@extends('layouts.admin.footer')