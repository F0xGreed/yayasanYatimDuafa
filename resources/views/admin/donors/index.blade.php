@extends('layouts.master')

@section('title', 'Data Donatur')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Donatur</h2>
    <a href="{{ route('donors.create') }}" class="btn btn-primary">➕ Tambah Donatur</a>
</div>

{{-- Tabel Donatur Lama --}}
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($donors as $donor)
        <tr>
            <td>{{ $donor->name }}</td>
            <td>{{ $donor->email }}</td>
            <td>{{ $donor->phone }}</td>
            <td>{{ $donor->address }}</td>
            <td>
                <a href="{{ route('donors.edit', $donor->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                <form action="{{ route('donors.destroy', $donor->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">🗑️ Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Tabel Baru: Akun Publik Terdaftar --}}
<hr>
<h3>Akun Publik Terdaftar</h3>
<table class="table table-striped table-bordered mt-3">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Tanggal Daftar</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($publicUsers as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at->format('d M Y') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">Belum ada akun publik yang terdaftar.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
