<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product | Clickclean</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

@include('layouts.header')

<div class="container mt-5">
    <div class="row" id="list-product">

        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <a href="{{ route('products.show', $product->id) }}" class="card-link">
                    <img src="{{ asset('img/' . $product->image) }}" class="card-img-top" alt="product">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->title }}</h5>
                        <p class="card-text">
                            <strong>Harga :</strong> Rp {{ number_format($product->harga) }}
                        </p>
                    </div>
                </a>

                <div class="card-body pt-0">
                    <form action="{{ route('checkout.buy', $product->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="jumlah_pesan" value="1">

                        <button type="submit" class="btn btn-primary w-100">
                            Beli Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@include('layouts.footer')
</body>
</html>