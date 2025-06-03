<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yayasan Yatim Dhuafa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: #fff;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            position: relative;
            background: url('{{ asset('images/pic2.png') }}') no-repeat center center fixed;
            background-size: cover;
            z-index: 0;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(50, 50, 50, 0.4);
            z-index: -1;
        }

        header {
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .nav-links a {
            margin-left: 20px;
            text-decoration: none;
            color: white;
            font-weight: 500;
            padding: 8px 16px;
            border: 2px solid white;
            border-radius: 8px;
        }

        .nav-links a:hover {
            background-color: white;
            color: #FF7F00;
        }

        main {
            text-align: center;
            padding: 40px 20px;
            z-index: 1;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto 30px;
        }

        .btn {
            font-size: 1rem;
            padding: 12px 24px;
            margin: 0 10px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-donasi {
            background-color: white;
            color: #FF7F00;
        }

        .btn-login {
            background-color: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-donasi:hover {
            background-color: #f1f1f1;
        }

        .btn-login:hover {
            background-color: white;
            color: #FF7F00;
        }

        .campaigns {
            padding: 40px 20px;
            background-color: rgba(255, 255, 255, 0.1);
            border-top: 1px solid rgba(255, 255, 255, 0.3);
        }

        .campaign {
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            padding: 20px;
            margin: 20px auto;
            max-width: 700px;
            color: white;
        }

        .campaign h3 {
            margin-top: 0;
        }

        footer {
            margin-top: auto;
            padding: 20px;
            text-align: center;
            font-size: 0.9rem;
            z-index: 1;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('images/pic3.png') }}" alt="Logo" style="height: 50px; vertical-align: middle;">
            <span style="margin-left: 10px;">
                <a href="/" style="text-decoration: none; color: white;">Yayasan Yatim Dhuafa</a>
            </span>
        </div>
        <div class="nav-links">
            <a href="{{ route('login') }}" class="btn-login">Login</a>
        </div>
    </header>

    <main>
        <h1>Berbagi Kebahagiaan Bersama</h1>
        <p>Bantu anak-anak yatim dan dhuafa mendapatkan kehidupan yang lebih layak melalui program donasi dan kegiatan sosial kami.</p>
        <div>
            <a href="{{ route('donasi') }}" class="btn btn-donasi">Donasi Publik</a>
            <a href="{{ route('donasi.tracking.form') }}" class="btn btn-login" style="margin-left: 10px;">🔍 Lacak Donasi</a>
            <a href="{{ route('login') }}" class="btn btn-login" style="margin-left: 10px;">Login</a>
        </div>
    </main>

    <section class="campaigns">
        <h2 style="text-align: center; color: white;">Kampanye Donasi Aktif</h2>
        @php
            use Illuminate\Support\Str;
            use Carbon\Carbon;
        @endphp
        @forelse($campaigns as $campaign)
            <div class="campaign">
                @if ($campaign->gambar)
                    <img src="{{ $campaign->gambar_url }}" alt="Gambar Kampanye" style="max-width: 100%; border-radius: 8px; margin-bottom: 15px;">
                @endif
                <h3>{{ $campaign->judul }}</h3>
                <p>{{ Str::limit($campaign->deskripsi, 120) }}</p>
                <p><strong>Target:</strong> Rp{{ number_format($campaign->target_donasi, 0, ',', '.') }}</p>
                <p><strong>Batas Waktu:</strong> 
                    {{ 
                        Carbon::parse($campaign->tanggal_selesai)
                            ->locale('id')
                            ->translatedFormat('d F Y') 
                    }}
                </p>
                <a href="{{ route('campaigns.show', $campaign->id) }}" class="btn btn-donasi">Donasi ke Kampanye</a>
            </div>
        @empty
            <p style="text-align: center;">Belum ada kampanye aktif saat ini.</p>
        @endforelse
    </section>

    <footer>
        &copy; {{ date('Y') }} Yayasan Yatim Dhuafa. All rights reserved.
    </footer>
</body>
</html>
