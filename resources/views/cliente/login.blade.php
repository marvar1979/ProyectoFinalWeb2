@extends('layouts.cliente')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="login-card">
    <h2>Iniciar sesión</h2>
    {{-- Aquí puedes integrar tu formulario de login de Laravel si lo deseas --}}
    <form>
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico:</label>
            <input type="email" id="email" class="form-control" required>
        </div>
        <div class="mb-4">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-submit">Iniciar sesión</button>
        <a href="#" class="create-account-link">Crea una Cuenta!</a>
    </form>
</div>
@endsection