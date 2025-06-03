<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengeluaran</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 8px; text-align: left; }
        h3 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h3>Laporan Pengeluaran</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengeluarans as $index => $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td>Rp{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                <td>{{ $item->kategori }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
