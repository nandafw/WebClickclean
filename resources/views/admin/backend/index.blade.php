@extends('layouts.backend.master')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="row">

    {{-- PRODUCT --}}
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="d-flex align-items-center">
                    <div class="stats-icon purple me-3">
                        <i class="bi bi-box2-fill"></i>
                    </div>
                    <div>
                        <h6 class="text-muted">Product</h6>
                        <h6 class="fw-bold mb-0">{{ $totalProduct }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ORDER --}}
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="d-flex align-items-center">
                    <div class="stats-icon blue me-3">
                        <i class="bi bi-cart-fill"></i>
                    </div>
                    <div>
                        <h6 class="text-muted">Pemesanan</h6>
                        <h6 class="fw-bold mb-0">{{ $totalOrder }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CUSTOMER --}}
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="d-flex align-items-center">
                    <div class="stats-icon green me-3">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <h6 class="text-muted">Customer</h6>
                        <h6 class="fw-bold mb-0">{{ $totalCustomer }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- USER --}}
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="d-flex align-items-center">
                    <div class="stats-icon red me-3">
                        <i class="bi bi-person-lines-fill"></i>
                    </div>
                    <div>
                        <h6 class="text-muted">Total User</h6>
                        <h6 class="fw-bold mb-0">{{ $totalUser }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- INSIGHT --}}
<div class="row mt-3">
    <div class="col-md-6">
        <div class="card p-3">
            <h6 class="text-muted">User Bulan Ini</h6>
            <h4 class="fw-bold">{{ $userThisMonth }}</h4>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-3">
            <h6 class="text-muted">Peningkatan User</h6>
            <h4 class="fw-bold {{ $growth >= 0 ? 'text-success' : 'text-danger' }}">
                {{ number_format($growth, 1) }}%
            </h4>
        </div>
    </div>
</div>

{{-- CHART --}}
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Analisis Pengguna Clickclean</h4>
            </div>
            <div class="card-body">
                <div id="chart-profile-visit"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    var options = {
        series: [{
            name: 'Jumlah User',
            data: @json($totals)
        }],
        chart: {
            type: 'area',
            height: 350
        },
        stroke: {
            curve: 'smooth'
        },
        xaxis: {
            categories: @json($months)
        },
        title: {
            text: 'Pertumbuhan Pengguna per Bulan'
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-profile-visit"), options);
    chart.render();
</script>
@endsection