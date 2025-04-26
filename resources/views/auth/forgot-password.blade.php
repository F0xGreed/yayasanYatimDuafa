@extends('layouts.master')

@section('title', 'Lupa Password')

@section('content')
<div class="card mx-auto" style="max-width: 500px;">
    <div class="card-header">🔑 Lupa Password</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" name="email" id="email" class="form-control" required autofocus>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Kirim Link Reset Password</button>
        </form>
    </div>
</div>
@endsection
