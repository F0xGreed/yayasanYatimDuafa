<!DOCTYPE html>
<html>
<head>
    <title>Donasi Berhasil</title>
</head>
<body>
    <h2>Terima kasih, {{ $donation->nama }}!</h2>
    <p>Donasi Anda sebesar <strong>Rp{{ number_format($donation->nominal, 0, ',', '.') }}</strong> telah kami terima.</p>

    @if (isset($donation->campaign))
        <p>Untuk kampanye: <strong>{{ $donation->campaign->judul }}</strong></p>
    @endif

    <p>Status saat ini: <strong>{{ ucfirst($donation->status) }}</strong></p>

    <p>Semoga kebaikan Anda dibalas berlipat ganda.</p>
</body>
</html>
