@extends('layouts.public')

@section('title', 'Pembayaran Berhasil')

@section('content')
    <div style="text-align: center; padding: 60px;">
        <h2 style="color: green;">🎉 Pembayaran Berhasil!</h2>
        <p>Terima kasih atas donasi Anda. Semoga menjadi amal jariyah.</p>

        @if(session('order_id'))
            <div style="margin-top: 20px;">
                <p><strong>Nomor Transaksi Anda:</strong></p>
                <div style="background: #f8f9fa; padding: 10px 20px; border-radius: 5px; font-weight: bold;">
                    {{ session('order_id') }}
                </div>

                <p style="margin-top: 10px;">
                    🔍 <a href="{{ route('donasi.tracking.form') }}" style="color: #007bff;">
                        Klik di sini untuk lacak status donasi
                    </a>
                </p>
            </div>
        @endif

        <a href="{{ url('/') }}" class="btn btn-success" style="margin-top: 30px;">Kembali ke Beranda</a>
    </div>
@endsection
