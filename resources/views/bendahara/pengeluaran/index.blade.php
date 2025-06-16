@extends('layouts.master')

@section('title', 'Laporan Pengeluaran')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')
    <h4 class="mb-4">📄 Laporan Pengeluaran</h4>

    <div class="mb-3">
        <a href="{{ route('laporan-pengeluaran.create') }}" class="btn btn-primary">➕ Tambah Pengeluaran</a>
    </div>

    <form method="GET" action="{{ route('laporan-pengeluaran.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
            <input type="text" id="tanggal_mulai" name="tanggal_mulai" class="form-control datepicker" value="{{ request('tanggal_mulai') }}">
        </div>
        <div class="col-md-4">
            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
            <input type="text" id="tanggal_selesai" name="tanggal_selesai" class="form-control datepicker" value="{{ request('tanggal_selesai') }}">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary me-2">Filter</button>
            <a href="{{ route('laporan-pengeluaran.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <div class="mb-3">
        <a href="{{ route('laporan-pengeluaran.exportExcel', request()->all()) }}" class="btn btn-success">📥 Ekspor Excel</a>
        <a href="{{ route('laporan-pengeluaran.exportPDF', request()->all()) }}" class="btn btn-danger" target="_blank">📄 Ekspor PDF</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Deskripsi</th>
                    <th>Jumlah</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
           <tbody>
    @forelse($pengeluarans as $index => $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
            <td>{{ $item->deskripsi }}</td>
            <td>Rp{{ number_format($item->jumlah, 0, ',', '.') }}</td>
            <td>{{ $item->kategori }}</td>
            <td>
                <a href="{{ route('laporan-pengeluaran.edit', ['laporan_pengeluaran' => $item->id]) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                
                <form action="{{ route('laporan-pengeluaran.destroy', ['laporan_pengeluaran' => $item->id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">🗑️ Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center">Tidak ada data pengeluaran.</td>
        </tr>
    @endforelse
</tbody>

        </table>
    </div>

    <div class="d-flex justify-content-end">
        {{ $pengeluarans->withQueryString()->links() }}
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr('.datepicker', {
        dateFormat: 'Y-m-d',
        allowInput: true
    });
</script>
@endpush
