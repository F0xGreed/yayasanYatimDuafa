@extends('layouts.public')

@section('title', 'Proses Pembayaran')

@section('content')
    <div style="text-align: center; padding: 50px;">
        <h2>Silakan Tunggu...</h2>
        <p>Anda akan diarahkan ke halaman pembayaran.</p>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            snap.pay("{{ $snapToken }}", {
                onSuccess: function(result) {
                    window.location.href = "{{ route('payment.success') }}";
                },
                onPending: function(result) {
                    window.location.href = "{{ route('payment.pending') }}";
                },
                onError: function(result) {
                    window.location.href = "{{ route('payment.failed') }}";
                },
                onClose: function() {
                    alert('Anda menutup halaman pembayaran tanpa menyelesaikannya.');
                }
            });
        });
    </script>
@endsection
