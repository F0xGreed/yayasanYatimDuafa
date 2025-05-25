@extends('layouts.master')

@section('title', 'Dashboard Bendahara')

@section('content')
<div class="container mt-5">
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card bg-success text-white shadow h-100">
                <div class="card-body">
                    <h5>Total Saldo</h5>
                    <h3>Rp {{ number_format($totalSaldo, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-warning text-dark shadow h-100">
                <div class="card-body">
                    <h5>Total Donasi Kampanye</h5>
                    <h3>Rp {{ number_format($totalDonasiKampanye, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h5>📊 Grafik Donasi</h5>
            <canvas id="barChart"></canvas>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <h5>📝 Donasi Terbaru</h5>
            <table class="table table-striped">
                <thead><tr><th>Nama</th><th>Nominal</th><th>Tanggal</th></tr></thead>
                <tbody>
                    @foreach($donasiTerbaru as $d)
                    <tr>
                        <td>{{ $d->nama }}</td>
                        <td>Rp {{ number_format($d->nominal, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($d->created_at)->format('d M Y') }}</td>
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
            backgroundColor: '#36b9cc'
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
