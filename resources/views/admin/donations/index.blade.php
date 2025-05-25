@extends('layouts.master')

@section('title', 'Donasi Publik')

@section('content')
<div class="container">
    <h3 class="mb-4">📥 Donasi Publik Terbaru</h3>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-light">
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
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada donasi masuk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end">
        {{ $donations->links() }}
    </div>
</div>
@endsection
