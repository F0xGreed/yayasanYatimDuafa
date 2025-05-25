@extends('layouts.master')

@section('title', 'Login')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow mx-auto" style="max-width: 400px;">
        <h3 class="text-center mb-4">🔐 Login</h3>
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if (session('status'))
            <div class="alert alert-info">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
                <div class="mt-2">
                    <a href="{{ route('password.request') }}" class="text-decoration-none small">Lupa Password?</a>
                </div>
            </div>

            <button type="submit" class="btn btn-warning w-100">Login</button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('landing') }}" class="btn btn-light text-muted">
                ← Kembali ke Beranda
            </a>
        </div>

        <p class="mt-3 text-center">
            Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
        </p>
    </div>
</div>
@endsection
