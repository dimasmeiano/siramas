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
                    <h2>Buku Tamu</h2>
                    <div class="row my-3">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    Total Tamu Hari Ini
                                    <h4>{{ $totalTamuHariIni }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    Total Tamu Bulan Ini
                                    <h4>{{ $totalTamuBulanIni }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    Total Tamu
                                    <h4>{{ $totalTamu }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h2>Inventaris</h2>
                    <div class="row my-3">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    Total Barang Rusak
                                    <h4>{{ $barangRusak }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    Total Barang DIpinjam
                                    <h4>{{ $barangDipinjam }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    Total Barang Hilang
                                    <h4>{{ $barangHilang }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    Total Barang
                                    <h4>{{ $totalBarang }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
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
