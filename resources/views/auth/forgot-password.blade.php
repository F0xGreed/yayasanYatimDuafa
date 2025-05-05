@extends('layouts.guest')

@section('title', 'Lupa Password')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow mx-auto" style="max-width: 400px;">
        <h3 class="text-center mb-4">🔑 Lupa Password</h3>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Alamat Email</label>
                <input type="email" name="email" class="form-control" required autofocus>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Kirim Link Reset</button>
        </form>

        <p class="mt-3 text-center">
            <a href="{{ route('login') }}" class="text-decoration-none">⬅️ Kembali ke Login</a>
        </p>
    </div>
</div>
@endsection
