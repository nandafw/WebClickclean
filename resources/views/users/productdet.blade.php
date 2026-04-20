<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Detail Product | Clickclean</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/productdet.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

@include('layouts.header')


<div class="container">
    <div class="product-container">

        <div class="product-image">
            <img src="{{ asset('img/' . $product->image) }}" alt="product">
        </div>

        <div class="product-details">
            <h2>{{ $product->title }}</h2>
            <table class="product-table">
                <tr>
                    <td class="product-label">Harga</td>
                    <td>:</td>
                    <td>Rp {{ number_format($product->harga) }}</td>
                </tr>
                <tr>
                    <td class="product-label">Keterangan</td>
                    <td>:</td>
                    <td>Produk Ini Merupakan{!! $product->desc !!}</td>
                </tr>
                <tr>
                    <td class="product-label">Jumlah</td>
                    <td>:</td>
                    <td>
                        <input type="number" id="jumlah_pesan" min="1" value="1" class="product-input">
                        <div class="button-group">
                            <form method="POST" action="{{ url('checkout/' . $product->id) }}">
                                @csrf
                                <input type="hidden" name="jumlah_pesan" id="cart_jumlah">
                                <button type="submit" class="btn btn-cart">
                                    Masukkan Keranjang
                                </button>
                            </form>

                            <form method="POST" action="{{ route('checkout.direct', $product->id) }}">
                                @csrf
                                <input type="hidden" name="jumlah_pesan" id="checkout_jumlah">
                                <button type="submit" class="btn btn-buy">
                                    Checkout Sekarang
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

@include('layouts.footer')

<script>
const input = document.getElementById('jumlah_pesan');
const cartInput = document.getElementById('cart_jumlah');
const checkoutInput = document.getElementById('checkout_jumlah');

function sync() {
    cartInput.value = input.value;
    checkoutInput.value = input.value;
}

input.addEventListener('input', sync);
window.onload = sync;
</script>

</body>
</html>