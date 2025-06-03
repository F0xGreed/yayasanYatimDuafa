@extends('layouts.public')

@section('title', 'Pembayaran Gagal')

@section('content')
    <div style="text-align: center; padding: 60px;">
        <h2 style="color: red;">❌ Pembayaran Gagal</h2>
        <p>Maaf, transaksi gagal diproses. Silakan coba lagi atau gunakan metode pembayaran lain.</p>
        <a href="{{ url('/') }}" class="btn btn-secondary" style="margin-top: 20px;">Kembali ke Beranda</a>
    </div>
@endsection
