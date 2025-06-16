@extends('layouts.master')

@section('title', 'Histori Donasi')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Histori Donasi Anda</h2>

    {{-- Donasi Publik --}}
    <h4>Donasi Publik</h4>
    @if($publicDonations->isEmpty())
        <p>Tidak ada riwayat donasi publik.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Nominal</th>
                    <th>Pesan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($publicDonations as $donasi)
                    <tr>
                        <td>{{ $donasi->created_at->format('d M Y H:i') }}</td>
                        <td>{{ $donasi->nama }}</td>
                        <td>Rp{{ number_format($donasi->nominal, 0, ',', '.') }}</td>
                        <td>{{ $donasi->pesan }}</td>
                        <td>
                            @if($donasi->status == 'settlement')
                                <span class="badge bg-success">Sukses</span>
                            @elseif($donasi->status == 'pending')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($donasi->status) }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <hr class="my-5">

    {{-- Donasi Kampanye --}}
    <h4>Donasi Kampanye</h4>
    @if($campaignDonations->isEmpty())
        <p>Tidak ada riwayat donasi kampanye.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Kampanye</th>
                    <th>Nominal</th>
                    <th>Pesan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($campaignDonations as $donasi)
                    <tr>
                        <td>{{ $donasi->created_at->format('d M Y H:i') }}</td>
                        <td>{{ $donasi->campaign->judul ?? '-' }}</td>
                        <td>Rp{{ number_format($donasi->nominal, 0, ',', '.') }}</td>
                        <td>{{ $donasi->pesan }}</td>
                        <td>
                            @if($donasi->status == 'settlement')
                                <span class="badge bg-success">Sukses</span>
                            @elseif($donasi->status == 'pending')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($donasi->status) }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
