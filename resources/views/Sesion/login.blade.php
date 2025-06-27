@extends('layouts.app')
@section('title', 'Iniciar Sesión')

@section('content')
<div class="mx-auto" style="max-width:450px;margin-top:50px;">
  <div class="card-custom p-4 shadow">
    <h3 class="text-center mb-4">Inicio de Sesión</h3>

    @if($errors->any())
      <div class="alert alert-danger">
        {{ $errors->first() }}
      </div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-3">
        <label class="form-label">Usuario</label>
        <input name="username" type="text"
               class="form-control @error('username') is-invalid @enderror"
               value="{{ old('username') }}" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <input name="password" type="password"
               class="form-control @error('password') is-invalid @enderror"
               required>
      </div>
      <div class="d-grid mb-3">
        <button class="btn btn-submit-custom" type="submit">Iniciar Sesión</button>
      </div>
    </form>

    <hr>

  </div>
</div>
@endsection
