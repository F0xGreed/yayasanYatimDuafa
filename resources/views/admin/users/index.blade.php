@extends('layouts.master')

@section('title', 'Daftar Akun')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Akun</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary">➕ Buat Akun Baru</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Dibuat Pada</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $index => $user)
            <tr>
                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>{{ $user->created_at->format('d M Y H:i') }}</td>
                <td class="text-center">
                    <div class="d-flex gap-1 justify-content-center">
                        {{-- Tombol Reset Password --}}
                        <form action="{{ route('users.resetPassword', $user->id) }}" method="POST" onsubmit="return confirm('Reset password user ini?');">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning">🔄 Reset</button>
                        </form>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">🗑️ Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada akun.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Pagination --}}
<div class="mt-3">
    {{ $users->links() }}
</div>
@endsection
