<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="SKYRENT Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="d-flex flex-column align-items-end w-100">
                    <div class="d-flex align-items-center mb-3">
                        <span class="navbar-text">
                            <a href="tel:081216061976">081216061976 - 081230127900</a> - <a href="mailto:skyrent@gmail.com">skyrent@gmail.com</a>
                        </span>
                        <a href="{{ route('login') }}" class="btn btn-primary ml-3">Login</a>
                    </div>
                    <ul class="navbar-nav">
                        <li class="nav-item {{ Request::routeIs('home') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('produkg') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('produkg') }}">Produk</a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('paket') ? 'active' : '' }}">
                            <a class="nav-link" href="#">Paket</a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('portofolio') ? 'active' : '' }}">
                            <a class="nav-link" href="#">Portofolio</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>