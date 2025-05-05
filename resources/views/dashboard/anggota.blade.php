@extends('layouts.master')

@section('title', 'Dashboard Anggota')

@section('content')
<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="mb-4">Dashboard Anggota</h2>
        <p>Selamat datang, {{ auth()->user()->name }}!</p>
    </div>
</div>
@endsection
