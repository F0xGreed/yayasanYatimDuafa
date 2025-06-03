@extends('layouts.public')

@section('title', 'Donasi')
@section('header-title', 'Form Donasi')
@section('header-subtitle', 'Bantu kami berbagi dengan sesama')

@section('content')
    <form action="{{ route('donasi.pay') }}" method="POST">
        @csrf

        <label for="name">Nama Donatur</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email Donatur</label>
        <input type="email" id="email" name="email" required>

        <label for="telepon">Nomor Telepon</label>
        <input type="text" id="telepon" name="telepon">

        <label for="amount">Nominal Donasi (Rp)</label>
        <input type="number" id="amount" name="amount" required>

        <label for="message">Pesan atau Doa</label>
        <textarea id="message" name="message" rows="4"></textarea>

        <button type="submit">Kirim Donasi</button>
    </form>

    <div style="margin-top: 30px;">
        <a href="{{ url('/') }}" style="
            display: inline-block;
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        " onmouseover="this.style.backgroundColor='#5a6268'" onmouseout="this.style.backgroundColor='#6c757d'">
            ← Kembali ke Beranda
        </a>
    </div>
@endsection
