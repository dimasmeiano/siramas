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
                    <div class="row my-3">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    Total Anggota
                                    <h4>{{ $jumlahAnggota }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Grafik Absensi --}}
                    <div class="card mb-4">
                        <div class="card-header">Grafik Absensi (Hadir per Bulan)</div>
                        <div class="card-body">
                            <canvas id="absensiChart"></canvas>
                        </div>
                    </div>

                    {{-- Grafik Keuangan --}}
                    <div class="card mb-4">
                        <div class="card-header">Grafik Keuangan Bulanan</div>
                        <div class="card-body">
                            <canvas id="keuanganChart"></canvas>
                        </div>
                    </div>

                    {{-- Progress Program Kerja --}}
                    <div class="card">
                        <div class="card-header">Progress Program Kerja</div>
                        <div class="card-body">
                            @foreach ($programs as $prog)
                                <p>{{ $prog->nama }}</p>
                                <div class="progress mb-3">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $prog->progress }}%;" aria-valuenow="{{ $prog->progress }}" aria-valuemin="0" aria-valuemax="100">
                                        {{ $prog->progress }}%
                                    </div>
                                </div>
                            @endforeach
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
@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const absensiCtx = document.getElementById('absensiChart').getContext('2d');
    const absensiChart = new Chart(absensiCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($absensiData->pluck('bulan')) !!},
            datasets: [{
                label: 'Jumlah Hadir',
                data: {!! json_encode($absensiData->pluck('total')) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)'
            }]
        }
    });

    const keuanganCtx = document.getElementById('keuanganChart').getContext('2d');
    const keuanganChart = new Chart(keuanganCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($keuanganData->pluck('bulan')) !!},
            datasets: [
                {
                    label: 'Pemasukan',
                    data: {!! json_encode($keuanganData->pluck('pemasukan')) !!},
                    borderColor: 'green',
                    fill: false
                },
                {
                    label: 'Pengeluaran',
                    data: {!! json_encode($keuanganData->pluck('pengeluaran')) !!},
                    borderColor: 'red',
                    fill: false
                }
            ]
        }
    });
</script>
@endpush