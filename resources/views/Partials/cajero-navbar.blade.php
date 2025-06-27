<nav class="navbar navbar-expand-lg navbar-dark admin-navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('cajero.dashboard') }}">Panel Cajero</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#cajeroNavbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="cajeroNavbarContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <!-- Menú Personas -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-people-fill me-1"></i> Personas
          </a>
          <ul class="dropdown-menu">
            {{-- Enlace a la lista de cliente del cajero --}}
            <li><a class="dropdown-item" href="{{ route('cajero.cliente.index') }}">Gestión de Cliente</a></li>
          </ul>
        </li>

        <!-- Menú Ventas -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
             <i class="bi bi-receipt-cutoff me-1"></i> Ventas
          </a>
          <ul class="dropdown-menu">
             {{-- Enlace a la sección de ventas del cajero --}}
            <li><a class="dropdown-item" href="{{ route('cajero.ventas.index') }}">Gestión de Venta</a></li>
             {{-- Enlace a la sección de reservaciones del cajero --}}
      </ul>
        </li>
      </ul>

      <!-- Menú de Usuario a la derecha -->
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle me-1"></i> Usuario
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Cambiar Contraseña</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form id="logout-form-cajero" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-cajero').submit();">
                    Cerrar Sesión
                </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
