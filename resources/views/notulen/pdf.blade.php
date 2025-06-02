<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Notulen</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        td, th { border: 1px solid #000; padding: 6px; }
    </style>
</head>
<body>
    <h2>Notulen  {{ $notulen->kegiatan->nama }}</h2>
    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($notulen->kegiatan->waktu_mulai)->translatedFormat('l, d F Y') }}</p>
    <p><strong>Tempat Rapat:</strong> {{$notulen->tempat}}</p>
    <p><strong>Pemimpin Rapat:</strong> {{$notulen->pemimpin->nama_lengkap}}</p>
    <p><strong>Jumlah Peserta:</strong> {{ $jumlahHadir }}</p>

    <h4>Isi Notulen:</h4>
    <p>{!! $notulen->isi_notulen !!}</p>

    <p><strong>Pemimpin Rapat</strong></p>
    <p>Ttd</p>
    <p>{{ $notulen->pemimpin->nama_lengkap }}</p>
    <h4>Absensi Peserta:</h4>
    <table>
        <thead>
            <tr>
                <th>Nama Anggota</th>
                <th>Status</th>
                <th>Waktu Absen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notulen->kegiatan->absensi as $absen)
                <tr>
                    <td>{{ $absen->anggota->nama_lengkap }}</td>
                    <td>{{ ucfirst($absen->status) }}</td>
                    <td>{{ \Carbon\Carbon::parse($absen->waktu_absen)->translatedFormat('d M Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>