<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Invoice | Clickclean</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/invoice.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
@include('layouts.header')

<div class="container">

    <h1><i class="fa fa-file-text"></i> Invoice</h1>

    <div class="card">
        <p><strong>Nama :</strong> {{ $pesanan->nama }}</p>
        <p><strong>No HP :</strong> {{ $pesanan->no_hp }}</p>
        <p><strong>Alamat :</strong> {{ $pesanan->alamat }}</p>
        <p><strong>Kode Pesanan :</strong> {{ $pesanan->kode }}</p>

        <p><strong>Status :</strong> 
            @if($pesanan->status == 'success' || $pesanan->status == 'paid')
                <span class="status success">Lunas</span>
            @elseif($pesanan->status == 'pending')
                <span class="status pending">Menunggu</span>
            @else
                <span class="status failed">Gagal</span>
            @endif
        </p>
    </div>

    <div class="card">
        <h3>Ringkasan Pesanan</h3>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesanan_details as $i => $item)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $item->product->title }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>Rp {{ number_format($item->product->harga) }}</td>
                    <td>Rp {{ number_format($item->jumlah_harga) }}</td>
                </tr>
                @endforeach

                <tr>
                    <td colspan="4" align="right"><strong>Total</strong></td>
                    <td><strong>Rp {{ number_format($pesanan->jumlah_harga) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>