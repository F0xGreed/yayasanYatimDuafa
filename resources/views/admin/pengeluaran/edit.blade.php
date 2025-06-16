@extends('layouts.master')

@section('title', 'Edit Pengeluaran')

@section('content')
    <h4 class="mb-4">Edit Data Pengeluaran</h4>

<form method="POST" action="{{ route('laporan-pengeluaran.update', $pengeluaran->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control"
                value="{{ old('tanggal', $pengeluaran->tanggal) }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi">Deskripsi</label>
            <input type="text" name="deskripsi" id="deskripsi" class="form-control"
                value="{{ old('deskripsi', $pengeluaran->deskripsi) }}" required>
        </div>

        <div class="mb-3">
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control"
                value="{{ old('jumlah', $pengeluaran->jumlah) }}" required>
        </div>

        <div class="mb-3">
            <label for="kategori">Kategori</label>
            <input type="text" name="kategori" id="kategori" class="form-control"
                value="{{ old('kategori', $pengeluaran->kategori) }}" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('laporan-pengeluaran.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
