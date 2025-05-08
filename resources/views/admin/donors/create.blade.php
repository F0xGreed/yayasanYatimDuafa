@extends('layouts.master')

@section('title', 'Tambah Donatur')

@section('content')
<h2>➕ Tambah Donatur</h2>

<form action="{{ route('donors.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email (opsional)</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Telepon (opsional)</label>
        <input type="text" class="form-control" id="phone" name="phone">
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Alamat (opsional)</label>
        <textarea class="form-control" id="address" name="address" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('donors.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
