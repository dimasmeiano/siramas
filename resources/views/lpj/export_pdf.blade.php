<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ringkasan LPJ - {{ $lpj->nama_kegiatan }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2, h4 { text-align: center; margin: 0; padding: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td, th { padding: 8px; border: 1px solid #000; text-align: left; }
        .dokumentasi { margin-top: 20px; }
        .footer { margin-top: 40px; text-align: right; }
    </style>
</head>
<body>

    <h2>Laporan Pertanggungjawaban Kegiatan</h2>
    <h4>{{ $lpj->nama_kegiatan }}</h4>

    <table>
        <tr>
            <th>Nama Kegiatan</th>
            <td>{{ $lpj->nama_kegiatan }}</td>
        </tr>
        <tr>
            <th>Tanggal Pelaksanaan</th>
            <td>{{ \Carbon\Carbon::parse($lpj->tanggal_pelaksanaan)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <th>Penanggung Jawab</th>
            <td>{{ $lpj->penanggungJawab->nama_lengkap ?? '-' }}</td>
        </tr>
        <tr>
            <th>Anggaran Dana</th>
            <td>Rp{{ number_format($lpj->anggaran_dana, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Dana Terealisasi</th>
            <td>Rp{{ number_format($lpj->dana_terealisasi, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Program Kerja</th>
            <td>{{ $lpj->programKerja->nama ?? '-' }}</td>
        </tr>
        <tr>
            <th>Ringkasan Kegiatan</th>
            <td>{{ $lpj->ringkasan_kegiatan ?? '-' }}</td>
        </tr>
    </table>

  @if ($lpj->dokumentasi && $lpj->dokumentasi->count())
    <div class="dokumentasi">
        <h4>Dokumentasi Kegiatan</h4>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>File</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lpj->dokumentasi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ public_path('storage/' . $item->file_path) }}" alt="Dokumentasi" style="max-width:150px;">
                    </td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>Tidak ada dokumentasi.</p>
@endif

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d-m-Y H:i') }}</p>
    </div>

</body>
</html>