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
                    <a href="{{ route('members.index') }}" class="btn btn-primary w-20">
                        <i class="bi bi-arrow-left-circle-fill"></i>&nbsp; Kembali
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
                          @if($member->foto)
                          <div style="float: right; margin-left: 20px;">
                             <p><strong>Foto Anggota</strong><br>
                                 <img src="{{ asset('storage/' . $member->foto) }}" width="200" height="300" alt="Foto Anggota">
                             </p>
                          </div>
                          @else
                          <div style="float: right; margin-left: 20px;">
                             <p class="text-danger">Belum memiliki foto anggota.</p>
                          </div>
                         @endif
                         @if($member->qr_code)
                         <div style="float: right; margin-left: 20px;">
                             <p><strong>QR Code:</strong><br>
                                 <img src="{{ asset('storage/' . $member->qr_code) }}" width="300" height="300" alt="QR Code">
                             </p>
                            </div>
                             @else
                             <div style="float: right; margin-left: 20px;">
                             <p class="text-danger">Belum memiliki QR Codes Anggota.</p>
                             </div>
                         @endif
                          <p><strong>NIA:</strong> {{ $member->nia }}</p>
                    <p><strong>Nama:</strong> {{ $member->nama_lengkap }}</p>
                    <p><strong>Email:</strong> {{ $member->email }}</p>
                    <p><strong>Tempat, Tanggal Lahir:</strong> {{ $member->tempat_lahir }}, {{ $member->tanggal_lahir }}</p>
                    <p><strong>Jenis Kelamin:</strong> {{ $member->jenis_kelamin }}</p>
                    @if($member->pengurus)
                        <h4>Jabatan</h4>
                        <p><strong>Jabatan : </strong> {{ $member->pengurus->departement->name }}</p>
                    @else
                        <p class="text-danger">Belum memiliki Jabatan</p>
                    @endif

                    @if($member->user)
                        <h4>Akun Pengguna</h4>
                        <p><strong>Username:</strong> {{ $member->user->username }}</p>
                        <p><strong>Role:</strong>
                            {{ $member->user->roles->pluck('name')->join(', ') }}
                        </p>
                    @else
                        <p class="text-danger">Belum memiliki akun user.</p>
                    @endif


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