<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Riwayat Booking | Clickclean</title>
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
        <i class="fa fa-calendar"></i> Riwayat Booking
    </div>

    @if($bookings->count() > 0)

        @foreach($bookings as $booking)
        <div class="history-card">

            <div class="history-header">
                <div>
                    <div class="history-code">Booking</div>
                    <div class="history-date">
                        {{ $booking->created_at->format('d M Y') }}
                    </div>
                </div>

                <span class="status {{ $booking->status }}">
                    {{ $booking->status }}
                </span>
            </div>

            <div class="history-item">
                <div class="item-left">
                    <div>
                        <div class="item-name">{{ $booking->nama }}</div>
                        <div class="item-sub">{{ $booking->no_hp }}</div>
                    </div>
                </div>
            </div>

            <div class="history-item">
                <div class="item-left">
                    <div class="item-sub">{{ $booking->alamat }}</div>
                </div>
            </div>

        </div>
        @endforeach

    @else
        <div class="empty-state">
            <i class="fa fa-calendar-times-o"></i>
            <p>Belum ada riwayat booking</p>
        </div>
    @endif

</div>
@include('layouts.footer')
</body>
</html>