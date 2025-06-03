@extends('layouts.public')

@section('title', 'Pembayaran Tertunda')

@section('content')
    <div style="text-align: center; padding: 60px;">
        <h2 style="color: orange;">⏳ Pembayaran Tertunda</h2>
        <p>Donasi Anda sedang menunggu konfirmasi. Mohon selesaikan pembayaran sesuai instruksi dari Midtrans.</p>
        <a href="{{ url('/') }}" class="btn btn-warning" style="margin-top: 20px;">Kembali ke Beranda</a>
    </div>
@endsection
