@extends('layouts.master')

@section('title', 'Gallery')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Galeri Yayasan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('galleries.create') }}" class="btn btn-primary mb-3">+ Tambah Gambar</a>

    <div class="row">
        @forelse($galleries as $gallery)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $gallery->gambar) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        @if($gallery->judul)
                            <h5 class="card-title">{{ $gallery->judul }}</h5>
                        @endif
                        @if($gallery->deskripsi)
                            <p class="card-text">{{ $gallery->deskripsi }}</p>
                        @endif
                        <a href="{{ route('galleries.edit', $gallery->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus gambar ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>Tidak ada gambar.</p>
        @endforelse
    </div>

    <div class="mt-4">{{ $galleries->links() }}</div>
</div>
@endsection
