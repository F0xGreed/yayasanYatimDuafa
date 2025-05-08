@extends('layouts.public')

@section('title', 'Donasi')
@section('header-title', 'Form Donasi')
@section('header-subtitle', 'Bantu kami berbagi dengan sesama')

@section('content')
    <form method="POST" action="{{ route('donasi.store') }}">
        @csrf

        <label for="nama">Nama Donatur</label>
        <input type="text" id="nama" name="nama" required>

        <label for="nominal">Nominal Donasi (Rp)</label>
        <input type="number" id="nominal" name="nominal" required>

        <label for="pesan">Pesan atau Doa</label>
        <textarea id="pesan" name="pesan" rows="4"></textarea>

        <button type="submit">Kirim Donasi</button>
    </form>
@endsection
