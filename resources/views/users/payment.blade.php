<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pembayaran | Clickclean</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <script src="{{config('midtrans.snap_url')}}" data-client-key="{{config('midtrans.client_key')}}"></script>
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

@include('layouts.header')

<div class="container">
    <div class="payment-card">
        <h2>Melanjutkan Pembayaran</h2>
        <p>Silakan klik tombol di bawah untuk membayar</p>

        <button id="pay-button" class="btn-pay">
            Bayar Sekarang
        </button>

        <div class="status-text">
            Transaksi aman dengan Midtrans
        </div>
    </div>
</div>

<script>
document.getElementById('pay-button').onclick = function () {
    window.snap.pay('{{$snapToken}}', {

        onSuccess: function(result) {
            window.location.href = "/payment/success/{{$pesanan->id}}";
        },

        onPending: function(result) {
            window.location.href = "/payment/success/{{$pesanan->id}}";
        },

        onError: function(result) {
            window.location.href = "/payment/failed/{{$pesanan->id}}";
        },

        onClose: function() {
            alert('Kamu Menutup Pembayaran');
        }
    });
};
</script>
</body>
</html>