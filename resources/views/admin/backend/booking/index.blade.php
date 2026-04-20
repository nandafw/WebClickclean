@extends('layouts.backend.master')

@section('title')
    Data Booking
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h4>@yield('title')</h4>
                </div>

                <div class="card-body">

                    <form action="" method="GET">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <label for="cari" class="form-label">Cari Booking</label>
                                <input type="text" name="cari" class="form-control" autocomplete="off"
                                    id="cari" placeholder="nama / paket / no hp">
                            </div>

                            <div class="col-md-3">
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-search"></i> Search
                                    </button>

                                    <button type="button" onClick="window.location.reload()" class="btn btn-danger">
                                        <i class="bi bi-arrow-clockwise"></i> Reload
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive mt-4">
                        <table class="table table-lg">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA</th>
                                    <th>PAKET LAYANAN</th>
                                    <th>NO HP</th>
                                    <th>ALAMAT</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>

                                        <td class="text-bold-500">
                                            {{ $booking->nama ?? '-' }}
                                        </td>

                                        <td class="text-bold-500">
                                            {{ $booking->paket_layanan ?? '-' }}
                                        </td>

                                        <td class="text-bold-500">
                                            {{ $booking->no_hp ?? '-' }}
                                        </td>

                                        <td class="text-bold-500">
                                            {{ $booking->alamat ?? '-' }}
                                        </td>

                                        <td class="d-flex gap-1">
                                            <form action="{{ route('admin.booking.destroy', $booking->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn icon btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus booking ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection