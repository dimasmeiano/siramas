<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px;}
        th, td { border: 1px solid #000; padding: 8px; text-align: left;}
        th { background-color: #eee;}
    </style>
</head>
<body>
    <h3>Laporan Keuangan</h3>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Program Kerja</th>
                <th>Jenis</th>
                <th>Nominal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($keuangan as $item)
                <tr>
                    <td>{{ $item->tanggal->format('d-m-Y') }}</td>
                    <td>{{ $item->programKerja->nama ?? 'Umum' }}</td>
                    <td>{{ ucfirst($item->jenis) }}</td>
                    <td>Rp {{ number_format($item->nominal, 2, ',', '.') }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>