@extends('layouts.master')

@section('title', 'Buat Akun')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Buat Akun Baru</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="admin">Admin</option>
                    <option value="bendahara">Bendahara</option>
                    <option value="anggota">Anggota</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Sandi</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Buat Akun</button>
        </form>
    </div>
</div>
@endsection
