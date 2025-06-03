@extends('layouts.public')

@section('title', 'Hasil Pelacakan Donasi')

@section('content')
    <div style="padding: 40px;">
        <h2>Hasil Pelacakan Donasi</h2>

        @if($donation)
            <ul>
                <li><strong>Nama:</strong> {{ $donation->nama }}</li>
                <li><strong>Email:</strong> {{ $donation->email }}</li>
                <li><strong>Nominal:</strong> Rp {{ number_format($donation->nominal, 0, ',', '.') }}</li>
                <li><strong>Status:</strong> {{ ucfirst($donation->status) }}</li>
                <li><strong>Order ID:</strong> {{ $donation->order_id }}</li>
            </ul>
        @else
            <p style="color: red;">Nomor transaksi tidak ditemukan.</p>
        @endif

        <a href="{{ route('donasi.tracking.form') }}" 
        style="display: inline-block; margin-top: 20px; color: #007bff; text-decoration: none; font-weight: 500;">
        ← Kembali
        </a>

    </div>
@endsection
