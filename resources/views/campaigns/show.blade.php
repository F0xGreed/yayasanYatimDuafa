@extends('layouts.master')

@section('title', 'Detail Kampanye')

@section('content')
<div class="container mt-4">
    <h2>📄 Detail Kampanye Donasi</h2>

    <div class="card mt-3 shadow-lg">
        @if ($campaign->gambar)
            <img src="{{ asset('storage/' . $campaign->gambar) }}" class="card-img-top" alt="Gambar Kampanye" style="max-height: 400px; object-fit: cover;">
        @endif

        <div class="card-body">
            <h4 class="card-title mb-3">{{ $campaign->judul }}</h4>

            <p class="card-text"><strong>📘 Deskripsi:</strong></p>
            <p>{{ $campaign->deskripsi }}</p>

            <p><strong>🎯 Target Donasi:</strong> Rp{{ number_format($campaign->target_donasi, 0, ',', '.') }}</p>
            <p><strong>🗓️ Batas Waktu:</strong> {{ \Carbon\Carbon::parse($campaign->tanggal_selesai)->translatedFormat('d F Y') }}</p>

            @php
                $total_donasi = $campaign->donations->sum('nominal');
                $persentase = min(100, ($total_donasi / $campaign->target_donasi) * 100);
            @endphp

            <p><strong>💰 Total Donasi Masuk:</strong> Rp{{ number_format($total_donasi, 0, ',', '.') }}</p>

            <div class="progress mb-3" style="height: 24px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $persentase }}%;" aria-valuenow="{{ $persentase }}" aria-valuemin="0" aria-valuemax="100">
                    {{ number_format($persentase, 0) }}%
                </div>
            </div>

            <a href="{{ route('campaigns.index') }}" class="btn btn-secondary mt-3">← Kembali ke Daftar Kampanye</a>
        </div>
    </div>
</div>
@endsection
