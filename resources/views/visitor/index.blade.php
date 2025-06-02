@extends('layouts.admin.header')
@include('layouts.admin.sidebar')
@section('content')
<main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
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
              <!--begin::Col-->
              <div class="col-lg-2 col-6">
                <!--begin::Small Box Widget 1-->
                <div class="small-box text-bg-primary" data-type="today">
                  <div class="inner">
                    <h3>{{ $today }}</h3>
                    <p>Hari Ini</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"
                    ></path>
                  </svg>
                  <a
                    href="#"
                    class="small-box-footer card-stat link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                    data-type="today"
                  >
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 1-->
              </div>
              <!--end::Col-->
              <div class="col-lg-2 col-6">
                <!--begin::Small Box Widget 2-->
                <div class="small-box text-bg-success">
                  <div class="inner">
                    <h3>{{ $yesterday }}</h3>
                    <p>Kemarin</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"
                    ></path>
                  </svg>
                  <a
                    href="#"
                    class="small-box-footer card-stat link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                    data-type="yesterday"
                    >
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 2-->
              </div>
              <!--end::Col-->
              <div class="col-lg-2 col-6">
                <!--begin::Small Box Widget 3-->
                <div class="small-box text-bg-warning">
                  <div class="inner">
                    <h3>{{ $week }}</h3>
                    <p>Minggu Ini</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"
                    ></path>
                  </svg>
                  <a
                    href="#"
                    class="small-box-footer card-stat link-dark link-underline-opacity-0 link-underline-opacity-50-hover"
                    data-type="week"
                  >
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 3-->
              </div>
              <!--end::Col-->
              <div class="col-lg-2 col-6">
                <!--begin::Small Box Widget 4-->
                <div class="small-box text-bg-danger">
                  <div class="inner">
                    <h3>{{ $month }}</h3>
                    <p>Bulan Ini</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                      d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"
                    ></path>
                    <path
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                      d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"
                    ></path>
                  </svg>
                  <a
                    href="#"
                    class="small-box-footer card-stat link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                    data-type="month"
                  >
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 4-->
              </div>
              <!--end::Col-->
              <div class="col-lg-2 col-6">
                <!--begin::Small Box Widget 4-->
                <div class="small-box text-bg-danger">
                  <div class="inner">
                    <h3>{{ $year }}</h3>
                    <p>Tahun Ini</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                      d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"
                    ></path>
                    <path
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                      d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"
                    ></path>
                  </svg>
                  <a
                    href="#"
                    class="small-box-footer card-stat link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                    data-type="year"
                  >
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 4-->
              </div>
              <!--end::Col-->
              <div class="col-lg-2 col-6">
                <!--begin::Small Box Widget 4-->
                <div class="small-box text-bg-danger">
                  <div class="inner">
                    <h3>{{ $total }}</h3>
                    <p>Total</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                      d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"
                    ></path>
                    <path
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                      d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"
                    ></path>
                  </svg>
                  <a
                    href="#"
                    class="small-box-footer card-stat link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                    data-type="total"
                  >
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 4-->
              </div>
              <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row">
              <!-- Start col -->
              <div class="col-lg-7 connectedSortable">
                <div class="card">
                    <div class="card-header">Detail Pengunjung</div>
                    <div class="card-body">
                        <canvas id="detailChart"></canvas>
                    </div>
                </div>
              </div>
              <!-- /.Start col -->
              <!-- Start col -->
              <div class="col-lg-5 connectedSortable">
                <div class="card">
                   <table id="detailTable" class="table table-bordered">
                        <thead>
                            <tr class="align-middle">
                                <th>Jam/Tanggal/Bulan/Tahun</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data detail akan diisi via JS -->
                        </tbody>
                    </table>
                </div>
              </div>
              <!-- /.Start col -->
            </div>
            <!-- /.row (main row) -->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
@extends('layouts.admin.footer')
@push('script')
<!-- Script Chart -->
       <script>
            const todayData = @json($todayLogs);
            const yesterdayData = @json($yesterdayLogs);
            const weekData = @json($weekLogs);
            const monthData = @json($monthLogs);
            const yearData = @json($yearLogs);
            const totalData = @json($totalLogs);
        </script>
        <script>
          function renderTable(labels, data) {
          const tbody = document.querySelector('#detailTable tbody');
          tbody.innerHTML = ''; // kosongkan dulu

          for (let i = 0; i < labels.length; i++) {
              const row = document.createElement('tr');

              const labelCell = document.createElement('td');
              labelCell.textContent = labels[i];

              const dataCell = document.createElement('td');
              dataCell.textContent = data[i];

              row.appendChild(labelCell);
              row.appendChild(dataCell);

              tbody.appendChild(row);
          }
        }

          function formatDateIndo(dateString) {
          const bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
          if (!dateString) return '';
          const parts = dateString.split('-'); // misal "2025-05-26" jadi ["2025","05","26"]
          if (parts.length !== 3) return dateString; // kalau bukan format yyyy-mm-dd, tampilkan apa adanya
          const year = parts[0];
          const month = parseInt(parts[1], 10) - 1;
          const day = parts[2];
          return `${day} ${bulan[month]} ${year}`;
      }
        </script>
       <script>
    const ctx = document.getElementById('detailChart').getContext('2d');

    // Format data jam untuk today & yesterday
    const hours = Array.from({ length: 24 }, (_, i) => i);
    const formatHourlyData = (data) =>
        hours.map(hour => {
            const found = data.find(d => d.hour == hour);
            return found ? found.total : 0;
        });

    // Format data tanggal untuk week & month
    const getDateLabels = (data) => data.map(d => d.date);
    const getDateCounts = (data) => data.map(d => d.total);

    // Inisialisasi Chart (default hari ini)
    let chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: hours.map(h => `${h}:00`),
            datasets: [{
                label: 'Kunjungan Hari Ini',
                data: formatHourlyData(todayData),
                backgroundColor: '#3498db',
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Event klik card
    document.querySelectorAll('.card-stat').forEach(card => {
        card.addEventListener('click', function () {
            const type = this.dataset.type;
            let label = '';
            let labels = [], data = [];

            switch(type) {
                case 'today':
                    label = 'Kunjungan Hari Ini';
                    labels = hours.map(h => `${h}:00`);
                    data = formatHourlyData(todayData);
                    break;
                case 'yesterday':
                    label = 'Kunjungan Kemarin';
                    labels = hours.map(h => `${h}:00`);
                    data = formatHourlyData(yesterdayData);
                    break;
                case 'week':
                    label = 'Kunjungan Minggu Ini';
                    labels = getDateLabels(weekData).map(formatDateIndo);
                    data = getDateCounts(weekData);
                    break;
                case 'month':
                    label = 'Kunjungan Bulan Ini';
                    labels = getDateLabels(monthData).map(formatDateIndo);;
                    data = getDateCounts(monthData);
                    break;
                case 'year':
                    label = 'Kunjungan Tahun Ini';
                    labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                    data = Array.from({ length: 12 }, (_, i) => {
                        const found = yearData.find(d => d.month == (i + 1));
                        return found ? found.total : 0;
                    });
                    break;

                case 'total':
                    label = 'Total Pengunjung per Tahun';
                    labels = totalData.map(d => `Tahun ${d.year}`);
                    data = totalData.map(d => d.total);
                    break;
            }

            chart.data.labels = labels;
            chart.data.datasets[0].data = data;
            chart.data.datasets[0].label = label;
            chart.update();

              // Update tabel detail juga
              const formattedLabels = labels.map(formatDateIndo);
              renderTable(formattedLabels, data);
        });
    });
</script>
@endpush