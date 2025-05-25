<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Donasi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Rekap Donasi Publik</h2>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Nominal</th>
                <th>Pesan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($donations as $donation)
            <tr>
                <td>{{ $donation->nama }}</td>
                <td>{{ $donation->email }}</td>
                <td>{{ $donation->telepon }}</td>
                <td>Rp {{ number_format($donation->nominal, 0, ',', '.') }}</td>
                <td>{{ $donation->pesan }}</td>
                <td>{{ $donation->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
