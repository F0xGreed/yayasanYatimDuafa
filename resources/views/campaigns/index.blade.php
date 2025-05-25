@extends('layouts.master')

@section('title', 'Daftar Kampanye Donasi')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>📅 Daftar Kampanye Donasi</h2>
        @can('create', App\Models\Campaign::class)
            <a href="{{ route('campaigns.create') }}" class="btn btn-success">➕ Tambah Kampanye</a>
        @endcan
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            @if ($campaigns->isEmpty())
                <p class="text-muted text-center">Belum ada kampanye donasi.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Target Donasi</th>
                            <th>Tanggal Selesai</th>
                            <th>Total Donasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($campaigns as $campaign)
                        <tr>
                            <td>
                                @if ($campaign->gambar)
                                    <img src="{{ asset('storage/' . $campaign->gambar) }}" alt="Gambar Kampanye" style="max-width: 80px;">
                                @else
                                    <small class="text-muted">Tidak ada</small>
                                @endif
                            </td>
                            <td>{{ $campaign->judul }}</td>
                            <td>Rp{{ number_format($campaign->target_donasi, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($campaign->tanggal_selesai)->translatedFormat('d F Y') }}</td>
                            <td>Rp{{ number_format($campaign->donations->sum('nominal'), 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('campaigns.show', $campaign->id) }}" class="btn btn-info btn-sm">Lihat</a>

                                @can('update', $campaign)
                                    <a href="{{ route('campaigns.edit', $campaign->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                @endcan

                                @can('delete', $campaign)
                                    <form action="{{ route('campaigns.destroy', $campaign->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus kampanye ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-3">
                    {{ $campaigns->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
