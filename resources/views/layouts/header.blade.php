<header class="navbar">
    <div class="nav-container">

        <div class="nav-left">
            <img class="logo" src="{{ asset('images/Logo.png') }}" alt="logo">
        </div>

        <nav>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('products.index') }}">Product</a></li>
                <li><a href="{{ route('user.booking.index') }}">Booking</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </nav>

        <div class="nav-right">
            @auth
                @php
                    $pesanan_utama = \App\Models\Pesanan::where('user_id', auth()->id())
                                        ->where('status', 'unpaid')
                                        ->first();

                    $notif = 0;

                    if ($pesanan_utama) {
                        $notif = \App\Models\PesananDetails::where('pesanan_id', $pesanan_utama->id)->count();
                    }
                @endphp

                <!-- CART -->
                <a href="{{ route('cart.index') }}" class="cart">
                    <i class="fa fa-shopping-cart"></i>
                    @if($notif > 0)
                        <span class="badge">{{ $notif }}</span>
                    @endif
                </a>

                <!-- DROPDOWN USER -->
                <div class="dropdown">
                    <button onclick="toggleDropdown()" class="dropbtn">
                        <i class="bi bi-person"></i>
                        {{ auth()->user()->name }}
                    </button>

                    <div id="dropdownMenu" class="dropdown-content">
                        <a href="#">Profile</a>

                        <a href="{{ route('riwayat.pesanan') }}">
                            <i class="fa fa-shopping-bag"></i> Riwayat Pesanan
                        </a>

                        <a href="{{ route('riwayat.booking') }}">
                            <i class="fa fa-calendar"></i> Riwayat Booking
                        </a>

                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">
                                <i class="fa fa-sign-out"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <div class="auth-buttons">
                    <a href="{{ route('login') }}" class="btn-login">Login</a>
                </div>
            @endguest

        </div>
    </div>
</header>

<script>
function toggleDropdown() {
    document.getElementById("dropdownMenu").classList.toggle("show");
}

window.onclick = function(event) {
    if (!event.target.closest('.dropdown')) {
        let dropdown = document.getElementById("dropdownMenu");
        if (dropdown) {
            dropdown.classList.remove('show');
        }
    }
}
</script>