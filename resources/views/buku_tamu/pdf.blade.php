<!DOCTYPE html>
<html>
<head>
    <title>Data Buku Tamu</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Data Buku Tamu</h2>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Instansi</th>
                <th>kontak</th>
                <th>Keperluan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->instansi }}</td>
                <td>{{ $item->kontak }}</td>
                <td>{{ $item->keperluan }}</td>
                <td>{{ $item->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>