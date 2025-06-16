@extends('layouts.master')

@section('title', 'Dashboard Anggota')

@section('content')
<div class="container mt-5">
    {{-- Ringkasan Total Saldo --}}
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm border-start border-success border-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-1">💰 Total Donasi Saya</h5>
                    <h3 class="text-success">Rp {{ number_format($totalDonasiUser, 0, ',', '.') }}</h3>
                    <small class="text-muted">Total dari semua donasi publik dan kampanye yang Anda lakukan</small>

                </div>
            </div>
        </div>
    </div>

    {{-- Donasi Terbaru --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">🕒 Donasi Terbaru</h5>
                    @if($donasiTerbaru->isEmpty())
                        <p class="text-muted">Belum ada donasi terbaru.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nominal</th>
                                        <th>Jenis</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($donasiTerbaru as $d)
                                    <tr>
                                        <td>Rp {{ number_format($d->nominal, 0, ',', '.') }}</td>
                                        <td>
                                            @if(isset($d->campaign_id))
                                                <span class="badge bg-primary">Kampanye</span>
                                            @else
                                                <span class="badge bg-secondary">Publik</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($d->created_at)->format('d M Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
