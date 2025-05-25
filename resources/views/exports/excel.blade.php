<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Donasi Excel</title>
</head>
<body>
    <h2>Rekap Donasi</h2>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Nominal</th>
                <th>Pesan</th>
                <th>Tipe</th>
                <th>Kampanye</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($donations as $index => $donation)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $donation->nama }}</td>
                <td>{{ $donation->email }}</td>
                <td>{{ $donation->telepon }}</td>
                <td>{{ $donation->nominal }}</td>
                <td>{{ $donation->pesan }}</td>
                <td>
                    @if (isset($donation->campaign))
                        Donasi Kampanye
                    @else
                        Donasi Publik
                    @endif
                </td>
                <td>{{ $donation->campaign->judul ?? '-' }}</td>
                <td>{{ $donation->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
