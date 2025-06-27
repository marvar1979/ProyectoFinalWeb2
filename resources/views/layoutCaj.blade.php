<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>

  <!-- CSS principal -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <!-- Tu CSS vintage personalizado -->
  <link href="{{ asset('css/vintage.css') }}" rel="stylesheet">

  @stack('styles')
</head>
<body>
  <header class="vintage-header">
    <div class="header-container">
      <h1 class="main-title">Panel de Administración</h1>
      <nav class="nav">
        <a href="{{ route('sales.indexC') }}" class="nav-link {{ request()->routeIs('sales.*') ? 'active' : '' }}">Ventas</a>
        <a href="{{ route('sales.create') }}" class="nav-link {{ request()->routeIs('sales.*') ? 'active' : '' }}">Vender</a>

      </nav>
    </div>
    <div class="section-title">
      @yield('content_header')
    </div>
  </header>

  <main class="content">
    @yield('content')
  </main>

  <script src="{{ asset('js/app.js') }}"></script>
  @stack('scripts')
</body>
</html>
