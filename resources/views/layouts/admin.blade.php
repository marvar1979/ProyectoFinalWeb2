<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Librería UNIVALLE')</title>

    <!-- Google Fonts (Georgia es una buena opción para el estilo vintage) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Georgia&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Estilos Vintage personalizados -->
    <link rel="stylesheet" href="{{ asset('css/vintage.css') }}">

    <!-- Icono de la página -->
    <link rel="icon" href="{{ asset('img/icono.png') }}">
</head>
<body class="d-flex flex-column min-vh-100">
    
    <!-- Barra de Navegación -->
    @include('partials.navbar')

    <!-- Contenido Principal -->
    <main class="container flex-grow-1 my-4">
        @yield('content')
    </main>

    <!-- Pie de Página -->
    @include('partials.footer')

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>