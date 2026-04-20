<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Riwayat Pesanan | Clickclean</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/history.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

@include('layouts.header')

<div class="container-history">

    <div class="page-title">
        <i class="fa fa-shopping-bag"></i> Riwayat Pesanan
    </div>

    @if($pesanans->count() > 0)

        @foreach($pesanans as $pesanan)
        <div class="history-card">

            <!-- HEADER -->
            <div class="history-header">
                <div>
                    <div class="history-code">#{{ $pesanan->kode }}</div>
                    <div class="history-date">
                        {{ $pesanan->tanggal }}
                    </div>
                </div>

                <span class="status {{ $pesanan->status }}">
                    {{ $pesanan->status }}
                </span>
            </div>

            <!-- TOTAL -->
            <div class="history-total">
                <span>Total Pesanan</span>
                <span>Rp {{ number_format($pesanan->jumlah_harga) }}</span>
            </div>

            <!-- BUTTON -->
            <div style="margin-top: 15px;">
                <a href="{{ route('invoice', $pesanan->id) }}" class="btn-view">
                    Lihat Invoice
                </a>
            </div>

        </div>
        @endforeach

    @else
        <div class="empty-state">
            <i class="fa fa-inbox"></i>
            <p>Belum ada riwayat pesanan</p>
        </div>
    @endif

</div>

@include('layouts.footer')

</body>
</html>