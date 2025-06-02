@extends('layouts.admin.header')
@push('style')
<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet" />
@endpush
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
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
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
                <div class="col-sm-6"><h3 class="mb-0">Galeri Foto Program: {{ $program->nama }}</h3></div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('program_galeri.create', $program->id) }}" class="btn btn-primary w-20">
                        <i class="bi bi-person-plus-fill"></i>&nbsp; Tambah Galeri
                    </a>
                </div>
              <div class="col-md">
                <div class="card mb-4">
                  <div class="card-body">
                    @if(isset($galeri) && $galeri->count())
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Caption</th>
                                <th>Order</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="sortable-gallery">
                            @foreach($galeri as $foto)
                            <tr data-id="{{ $foto->id }}">
                                <td>
                                    <a href="{{ asset('storage/' . $foto->photo_path) }}" class="lightbox">
                                        <img src="{{ asset('storage/' . $foto->photo_path) }}" width="150">
                                    </a>
                                <td>{{ $foto->caption }}</td>
                                <td>{{ $foto->order }}</td>
                                <td>
                                    <a href="{{ route('program_galeri.edit', [$program->id, $foto->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('program_galeri.destroy', [$program->id, $foto->id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin hapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <p>Belum ada foto di galeri program ini.</p>
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
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const el = document.getElementById('sortable-gallery');
    new Sortable(el, {
        animation: 150,
        onEnd: function () {
            const order = Array.from(el.children).map((row, index) => ({
                id: row.dataset.id,
                order: index + 1
            }));
            fetch('{{ route("program_galeri.reorder", $program->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ order })
            });
        }
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    GLightbox({ selector: '.lightbox' });
});
</script>
@endpush