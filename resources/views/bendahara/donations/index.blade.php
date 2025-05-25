@extends('layouts.master')

@section('title', 'Daftar Donasi Publik')

@section('content')
<div class="container">
    <h3 class="mb-4">📋 Daftar Donasi Publik</h3>

    <form method="GET" class="row g-3 align-items-end mb-4">
        <div class="col-md-4">
            <input type="text" name="nama" value="{{ request('nama') }}" class="form-control" placeholder="Cari Nama Donatur">
        </div>
        <div class="col-md-3">
            <label class="form-label">Tanggal Awal</label>
            <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" class="form-control">
        </div>
        <div class="col-md-3">
            <label class="form-label">Tanggal Akhir</label>
            <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="form-control">
        </div>
        <div class="col-md-2 d-flex gap-1">
            <button class="btn btn-primary w-100" type="submit">🔍 Filter</button>
        </div>

        <div class="col-md-12 d-flex gap-2">
            <a href="{{ route('donations.export', request()->query()) }}" class="btn btn-success">📥 Export Excel</a>
            <a href="{{ route('donations.exportPdf', request()->query()) }}" class="btn btn-danger" target="_blank">🖨️ Cetak PDF</a>
        </div>
    </form>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Nominal</th>
                <th>Pesan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($donations as $donation)
                <tr>
                    <td>{{ $donation->nama }}</td>
                    <td>{{ $donation->email }}</td>
                    <td>{{ $donation->telepon }}</td>
                    <td>Rp {{ number_format($donation->nominal, 0, ',', '.') }}</td>
                    <td>{{ $donation->pesan }}</td>
                    <td>{{ $donation->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">Tidak ada donasi ditemukan.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $donations->links() }}
</div>
@endsection
