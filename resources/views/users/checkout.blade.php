<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Keranjang | Clickclean</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    @include('layouts.header')
    <div class="container">
    <form action="{{ route('checkout.process', $pesanan->id) }}" method="POST">
        @csrf

        <div class="checkout-wrapper">

            <!-- LEFT: DATA PEMESAN -->
            <div class="checkout-left">
                <h2>Detail Pemesan</h2>

                <label>Nama Lengkap</label>
                <input type="text" name="nama" required>

                <label>No HP</label>
                <input type="text" name="no_hp" required>

                <label>Alamat Lengkap</label>
                <textarea name="alamat" rows="4" required></textarea>

            </div>

            <!-- RIGHT: RINGKASAN PESANAN -->
            <div class="checkout-right">
                <h2>Ringkasan Pesanan</h2>

                @foreach($pesanan_details as $item)
                <div class="product-item">
                    <img src="{{ asset('img/' . $item->product->image) }}">
                    <div class="product-info">
                        <div>{{ $item->product->title }}</div>
                        <small>{{ $item->jumlah }} x Rp {{ number_format($item->product->harga) }}</small>
                    </div>
                    <div>
                        Rp {{ number_format($item->jumlah_harga) }}
                    </div>
                </div>
                @endforeach

                <hr>

                <div class="total">
                    Total: Rp {{ number_format($pesanan->jumlah_harga) }}
                </div>

                <button type="submit" class="btn-pay">
                    <i class="fa fa-lock"></i> Bayar Sekarang
                </button>

            </div>

        </div>
    </form>
</div>
</body>
</html>