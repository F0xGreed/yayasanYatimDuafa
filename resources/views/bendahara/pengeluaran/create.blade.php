@extends('layouts.master')

@section('title', 'Tambah Pengeluaran')

@section('content')
    <h4 class="mb-4">Tambah Data Pengeluaran</h4>

    <form method="POST" action="{{ route('laporan-pengeluaran.store') }}">
        @csrf

        <div class="mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control"
                value="{{ old('tanggal') }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi">Deskripsi</label>
            <input type="text" name="deskripsi" id="deskripsi" class="form-control"
                value="{{ old('deskripsi') }}" required>
        </div>

        <div class="mb-3">
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control"
                value="{{ old('jumlah') }}" required>
        </div>

        <div class="mb-3">
            <label for="kategori">Kategori</label>
            <input type="text" name="kategori" id="kategori" class="form-control"
                value="{{ old('kategori') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('laporan-pengeluaran.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
