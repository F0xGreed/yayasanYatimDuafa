@extends('layouts.master')

@section('title', 'Rekap Donasi')

@section('content')
<div class="container">
    <h3 class="mb-4">📊 Rekap Donasi Publik</h3>

    {{-- Total Donasi --}}
    <div class="alert alert-info d-flex justify-content-between align-items-center">
        <div><strong>Total Donasi Ditampilkan:</strong></div>
        <div class="fs-5">Rp {{ number_format($totalNominal, 0, ',', '.') }}</div>
    </div>

    {{-- Grafik --}}
    <canvas id="donationChart" height="100"></canvas>

    <hr class="my-4">

    {{-- Filter --}}
    <form method="GET" class="row g-3 mb-4 align-items-end">
        <div class="col-md-4">
            <label for="nama" class="form-label">Nama Donatur</label>
            <input type="text" name="nama" value="{{ request('nama') }}" class="form-control" placeholder="Cari Nama">
        </div>
        <div class="col-md-3">
            <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
            <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" class="form-control">
        </div>
        <div class="col-md-3">
            <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
            <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="form-control">
        </div>
        <div class="col-md-2 text-end">
            <label class="form-label d-block">&nbsp;</label>
            <div class="btn-group d-flex" role="group">
                <button class="btn btn-primary me-1" type="submit">🔍 Filter</button>
                <a href="{{ route('rekap-donasi.export', request()->query()) }}" class="btn btn-success me-1">📥 Excel</a>
                <a href="{{ route('rekap-donasi.exportPdf', request()->query()) }}" class="btn btn-danger">🖨 PDF</a>
            </div>
        </div>
    </form>

    {{-- Tabel --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Nominal</th>
                    <th>Pesan</th>
                    <th>Kampanye</th>
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
                        <td>{{ $donation->campaign ? $donation->campaign->judul : 'Donasi Publik' }}</td>
                        <td>{{ $donation->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Tidak ada data donasi.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <div class="d-flex justify-content-end">
        {{ $donations->withQueryString()->links() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('donationChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartData->pluck('bulan')) !!},
            datasets: [{
                label: 'Total Donasi (per bulan)',
                data: {!! json_encode($chartData->pluck('total')) !!},
                backgroundColor: '#4e73df'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: true, text: 'Grafik Donasi per Bulan' }
            },
            scales: {
                y: {
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
