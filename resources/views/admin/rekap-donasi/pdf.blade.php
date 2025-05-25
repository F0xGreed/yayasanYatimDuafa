<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Donasi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 0; }
        p { text-align: center; margin-top: 4px; font-size: 11px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        tfoot td { font-weight: bold; background-color: #f9f9f9; }
    </style>
</head>
<body>
    <h2>Rekap Donasi</h2>
    <p>Dicetak tanggal: {{ now()->format('d-m-Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Nominal</th>
                <th>Pesan</th>
                <th>Kampanye</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($donations as $donation)
            <tr>
                <td>{{ $donation->nama }}</td>
                <td>{{ $donation->email }}</td>
                <td>{{ $donation->telepon }}</td>
                <td>Rp {{ number_format($donation->nominal, 0, ',', '.') }}</td>
                <td>{{ $donation->pesan }}</td>
                <td>{{ $donation->campaign->judul ?? 'Publik' }}</td>
                <td>{{ $donation->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            @php $total += $donation->nominal; @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">Total Donasi</td>
                <td colspan="4">Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
