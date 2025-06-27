<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('cliente.home') }}">
            <i class="bi bi-book-half me-2 fs-4"></i>
            <span>Librería</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cliente.home') ? 'active' : '' }}" href="{{ route('cliente.home') }}">🏠 Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cliente.about') ? 'active' : '' }}" href="{{ route('cliente.about') }}">📖 Sobre Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cliente.cart') ? 'active' : '' }}" href="{{ route('cliente.cart') }}">🛒 Carrito</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">🔐 Iniciar Sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>