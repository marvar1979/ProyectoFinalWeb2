{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.cliente')

@section('title', 'Iniciar Sesión')

@push('styles')
<link href="{{ asset('css/vintage.css') }}" rel="stylesheet">
@endpush

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 80vh; padding: 1rem;">
  <div class="impact-container" style="max-width: 400px; margin: 0;">
    <div class="page-header">
      <h1>Iniciar Sesión</h1>
    </div>

    <form method="POST" action="{{ route('login') }}" class="impact-form">
      @csrf

      <div class="form-group">
        <label for="email">Email</label>
        <input 
          id="email" 
          type="email" 
          name="email" 
          value="{{ old('email') }}" 
          required 
          autofocus 
          class="form-control" 
          placeholder="tu@ejemplo.com"
        >
        @error('email')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="form-group">
        <label for="password">Contraseña</label>
        <input 
          id="password" 
          type="password" 
          name="password" 
          required 
          class="form-control" 
          placeholder="••••••••"
        >
        @error('password')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="form-group" style="margin-left: 180px;">
        <div class="form-check">
          <input 
            class="form-check-input" 
            type="checkbox" 
            name="remember" 
            id="remember" 
            {{ old('remember') ? 'checked' : '' }}
          >
          <label class="form-check-label" for="remember">
            Recordarme
          </label>
        </div>
      </div>

      <div class="form-footer">
        <button type="submit" class="btn-vintage">Entrar</button>
      </div>
    </form>
  </div>
</div>
@endsection
