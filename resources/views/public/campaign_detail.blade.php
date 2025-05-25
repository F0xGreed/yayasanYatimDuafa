@extends('layouts.public')

@section('container-style')
    background-color: rgba(0, 0, 0, 0.6); color: white;
@endsection

@push('styles')
    <style>
        h2, h3, p, label, strong {
            color: #f8f9fa !important;
        }

        img {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        input, textarea {
            background-color: #2c2c2c !important;
            color: #ffffff !important;
            border: 1px solid #444 !important;
            border-radius: 6px;
        }

        input::placeholder, textarea::placeholder {
            color: #bbb;
        }

        .btn-success {
            background-color: #28a745 !important;
            border: none;
            font-weight: bold;
        }

        .btn-success:hover {
            background-color: #218838 !important;
        }

        .progress {
            height: 24px;
            background-color: #444;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .progress-bar {
            background-color: #28a745;
            height: 100%;
            line-height: 24px;
            color: #fff;
            text-align: center;
            font-weight: bold;
        }

        hr {
            border-color: #666;
        }

        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }
    </style>
@endpush

@section('content')
    <div style="padding: 40px 20px; max-width: 800px; margin: auto;">
        <h2>{{ $campaign->judul }}</h2>

        @if ($campaign->gambar)
            <img src="{{ $campaign->gambar_url }}" alt="Gambar Kampanye" style="max-width: 100%; margin-bottom: 20px; border-radius: 8px;">
        @endif

        <p>{{ $campaign->deskripsi }}</p>
        <p><strong>Target Dana:</strong> Rp{{ number_format($campaign->target_donasi, 0, ',', '.') }}</p>
        <p><strong>Batas Waktu:</strong> {{ \Carbon\Carbon::parse($campaign->tanggal_selesai)->format('d M Y') }}</p>

        {{-- Progress Bar --}}
        @php
            $total_donasi = $campaign->donations->sum('nominal');
            $persentase = min(100, ($total_donasi / $campaign->target_donasi) * 100);
        @endphp

        <div style="margin-top: 20px;">
            <p><strong>Total Terkumpul:</strong> Rp{{ number_format($total_donasi, 0, ',', '.') }} ({{ number_format($persentase, 0) }}%)</p>
            <div class="progress">
                <div class="progress-bar" style="width: {{ $persentase }}%;">
                    {{ number_format($persentase, 0) }}%
                </div>
            </div>
        </div>

        <hr style="margin: 30px 0;">

        <h3>Form Donasi ke Kampanye</h3>
        <form action="{{ route('campaigns.donate', $campaign->id) }}" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
                <label>Nama Lengkap:</label>
                <input type="text" name="nama" class="form-control" required placeholder="Nama Lengkap">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" required placeholder="Email Aktif">
            </div>

            <div style="margin-bottom: 15px;">
                <label>No. Telepon:</label>
                <input type="text" name="telepon" class="form-control" required placeholder="08xxxxxxxxxx">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Nominal Donasi (Rp):</label>
                <input type="number" name="nominal" class="form-control" min="1000" required placeholder="Minimal Rp 1.000">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Pesan (Opsional):</label>
                <textarea name="pesan" class="form-control" rows="3" placeholder="Tulis pesan jika ada..."></textarea>
            </div>

            <button type="submit" class="btn btn-success">Kirim Donasi</button>
        </form>

        <div style="margin-top: 30px;">
            <a href="{{ url('/') }}" class="btn-back">← Kembali ke Beranda</a>
        </div>
    </div>
@endsection
