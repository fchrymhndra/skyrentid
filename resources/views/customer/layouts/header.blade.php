@if (auth()->user()->role === 'customer')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/logo.png') }}" alt="SKYRENT Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="d-flex flex-column align-items-end w-100">
                <div class="d-flex align-items-center mb-3">
                    <span class="navbar-text">
                        <a href="tel:081216061976">081216061976 - 081230127900</a> - <a href="mailto:skyrent@gmail.com">skyrent@gmail.com</a>
                    </span>
                        <span class="ml-3">{{ Auth::user()->nama }}</span>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item {{ Request::routeIs('beranda') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('beranda') }}">Beranda</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('produkc') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('produkc') }}">Produk</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('paket') ? 'active' : '' }}">
                        <a class="nav-link" href="#">Paket</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('portofolio') ? 'active' : '' }}">
                        <a class="nav-link" href="#">Portofolio</a>
                    </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
@endif