@extends('layouts.master')

@section('title', 'Register')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow mx-auto" style="max-width: 400px;">
        <h3 class="text-center">Daftar Akun</h3>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning w-100">Daftar</button>
        </form>
        <p class="mt-3 text-center">
            Sudah punya akun? <a href="{{ route('login') }}">Login</a>
        </p>

        <div class="text-center mt-3">
            <a href="{{ route('landing') }}" class="btn btn-light text-muted">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
