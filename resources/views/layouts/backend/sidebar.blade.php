<div class="sidebar-menu">
    <ul class="menu">

        <li class="sidebar-title">Utama</li>

        <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard')}}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        {{-- PRODUCT --}}
        <li class="sidebar-title">Product</li>

        <li class="sidebar-item {{ request()->routeIs('product.index') ? 'active' : '' }}">
            <a href="{{ route('product.index')}}" class='sidebar-link'>
                <i class="bi bi-box2-fill"></i>
                <span>Data Product</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->routeIs('product.create') ? 'active' : '' }}">
            <a href="{{ route('product.create')}}" class='sidebar-link'>
                <i class="bi bi-box-arrow-in-up"></i>
                <span>Tambah Product</span>
            </a>
        </li>

        {{-- PEMESANAN --}}
        <li class="sidebar-title">Pemesanan</li>

        <li class="sidebar-item {{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
            <a href="{{ route('admin.orders.index')}}" class='sidebar-link'>
                <i class="bi bi-cart-fill"></i>
                <span>Data Pesanan</span>
            </a>
        </li>

        {{-- BOOKING (BARU) --}}
        <li class="sidebar-item {{ request()->routeIs('admin.booking.index') ? 'active' : '' }}">
            <a href="{{ route('admin.booking.index')}}" class='sidebar-link'>
                <i class="bi bi-calendar-check-fill"></i>
                <span>Data Booking</span>
            </a>
        </li>

        {{-- USER (BARU) --}}
        <li class="sidebar-title">User</li>

        <li class="sidebar-item {{ request()->routeIs('admin.user*') ? 'active' : '' }}">
            <a href="{{ route('admin.users.index') ?? '#' }}" class='sidebar-link'>
                <i class="bi bi-people-fill"></i>
                <span>Data Pengguna</span>
            </a>
        </li>

    </ul>
</div>