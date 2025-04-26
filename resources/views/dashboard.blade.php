@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="card p-4">
        <h2>Selamat Datang di Dashboard Yayasan Yatim Dhuafa</h2>
        <p>Gunakan sidebar untuk mengelola data donatur, donasi, dan kegiatan.</p>
        
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card bg-warning text-white p-3">
                    <h5>Donasi Hari Ini</h5>
                    <p>Rp 5.000.000</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white p-3">
                    <h5>Total Donatur</h5>
                    <p>120 Orang</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-primary text-white p-3">
                    <h5>Program Berjalan</h5>
                    <p>5 Kegiatan</p>
                </div>
            </div>
        </div>
    </div>
@endsection
