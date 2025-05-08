@extends('layouts.master')

@section('title', 'Edit Donatur')

@section('content')
<h2>✏️ Edit Donatur</h2>

<form action="{{ route('donors.update', $donor->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $donor->name }}" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email (opsional)</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $donor->email }}">
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Telepon (opsional)</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{ $donor->phone }}">
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Alamat (opsional)</label>
        <textarea class="form-control" id="address" name="address" rows="3">{{ $donor->address }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('donors.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
