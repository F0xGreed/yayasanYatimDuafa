@extends('layouts.public')

@section('title', 'Cek Status Donasi')

@section('content')
    <div style="padding: 40px; text-align: center;">
        <h2>Cek Status Donasi Anda</h2>
        <form method="GET" action="{{ route('donasi.tracking.result') }}" style="margin-top: 20px;">
            <input type="text" name="order_id" placeholder="Masukkan Nomor Transaksi (order_id)" required>
            <button type="submit" style="margin-top: 10px;">Lacak Donasi</button>
        </form>
    </div>
@endsection
