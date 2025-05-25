@extends('layouts.master')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mt-5">
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-success shadow h-100">
                <div class="card-body">
                    <h6 class="card-title">💰 Total Saldo</h6>
                    <h4>Rp {{ number_format($totalSaldo, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info shadow h-100">
                <div class="card-body">
                    <h6 class="card-title">📆 Bulan Ini</h6>
                    <h4>Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow h-100">
                <div class="card-body">
                    <h6 class="card-title">👥 Jumlah Donatur</h6>
                    <h4>{{ $jumlahDonatur }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-dark shadow h-100">
                <div class="card-body">
                    <h6 class="card-title">🕒 Donasi Terakhir</h6>
                    <h5>{{ $donasiTerakhir ? \Carbon\Carbon::parse($donasiTerakhir)->format('d M Y') : '-' }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h5 class="card-title">📊 Grafik Donasi per Bulan</h5>
            <canvas id="barChart"></canvas>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title">📝 Donasi Terbaru</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Nominal</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donasiTerbaru as $donasi)
                        <tr>
                            <td>{{ $donasi->nama }}</td>
                            <td>Rp {{ number_format($donasi->nominal, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($donasi->created_at)->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('barChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($bulan) !!},
            datasets: [{
                label: 'Donasi per Bulan',
                data: {!! json_encode($totalPerBulan) !!},
                backgroundColor: '#4e73df'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: true, text: 'Total Donasi per Bulan' }
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
