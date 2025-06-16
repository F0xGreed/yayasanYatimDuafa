@extends('layouts.master')

@section('title', 'Edit Gambar Galeri')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Gambar Galeri</h2>
    <form action="{{ route('galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul', $gallery->judul) }}">
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $gallery->deskripsi) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar Saat Ini</label><br>
            <img src="{{ $gallery->gambar_url }}" alt="Gambar Galeri" style="max-width: 200px;">
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Ganti Gambar (Opsional)</label>
            <input type="file" name="gambar" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('galleries.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
