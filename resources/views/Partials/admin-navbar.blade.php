<nav class="navbar navbar-expand-lg navbar-dark admin-navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Panel Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="adminNavbarContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-box-seam-fill me-1"></i> Productos
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('admin.products.index') }}">Gestión de Producto</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-people-fill me-1"></i> Personas
          </a>
          <ul class="dropdown-menu">
         
            <li><a class="dropdown-item" href="{{ route('admin.usuarios.index') }}">Gestión de Usuario</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
             <i class="bi bi-receipt-cutoff me-1"></i> Ventas
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('admin.ventas.index') }}">Gestión de Ventas</a></li>
            <li><a class="dropdown-item" href="#">Gestión de Reportes</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('admin.reportes.index') }}">Reportes</a></li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle me-1"></i> Usuario
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Cambiar Contraseña</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form id="logout-form-admin" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();">
                    Cerrar Sesión
                </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
