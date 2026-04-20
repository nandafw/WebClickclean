@extends('layouts.backend.master')
@section('title')
    Daftar Product
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
                                <label for="cari" class="form-label">Cari Kata Kunci</label>
                                <input type="text" name="cari" class="form-control" autocomplete="off" id="cari">
                            </div>
                            <div class="col-md-3">
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-search"></i> Search
                                    </button>
                                    <button onClick="window.location.reload()" class="btn btn-danger">
                                        <i class="bi bi-arrow-clockwise"></i> Reload
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Table with outer spacing -->
                    <div class="table-responsive">
                        <table class="table table-lg">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>KODE PESANAN</th>
                                    <th>ID USER</th>
                                    <th>TOTAL</th>
                                    <th>STATUS PAYMENT</th>
                                    <th>TANGGAL</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach ($pesanans as $pesan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $pesan->kode }}</td>

                                    <td>{{ $pesan->user_id }}</td>

                                    <td>Rp {{ number_format($pesan->jumlah_harga) }}</td>

                                    <td>
                                        <span class="badge 
                                            @if($pesan->status == 'pending') bg-warning
                                            @elseif($pesan->status == 'paid') bg-success
                                            @elseif($pesan->status == 'failed') bg-danger
                                            @else bg-secondary
                                            @endif">
                                            {{ $pesan->status }}
                                        </span>
                                    </td>

                                    <td>{{ $pesan->created_at->format('d-m-Y') }}</td>

                                    <td class="d-flex gap-1">
                                        <form action="{{ route('admin.orders.destroy', $pesan->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Hapus pesanan ini?')">
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
