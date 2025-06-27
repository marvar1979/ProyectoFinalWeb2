<!-- La clase 'navbar-custom' es para tus estilos personalizados desde vintage.css -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <i class="bi bi-book-half me-2 fs-4"></i>
            <span>Librería</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Los links de la derecha -->
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    {{-- La función request()->routeIs('home') añade la clase 'active' si estás en esa ruta --}}
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">🏠 Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('carrito') ? 'active' : '' }}" href="{{ route('carrito') }}">🛒 Carrito</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">🔐 Iniciar Sesión</a>
                </li>
                 <li class="nav-item">
                    {{-- Este enlace puede dirigir a una sección de la página principal o a una ruta específica --}}
                    <a class="nav-link" href="{{ url('/#nosotros') }}">📖 Sobre Nosotros</a>
                </li>
            </ul>
        </div>
    </div>
</nav>