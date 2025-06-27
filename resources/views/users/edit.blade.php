@extends('layout')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Usuario #{{ $user->id }}</h1>
@stop

@section('content')
<div class="card card-light">
  <div class="card-header">
    <h3 class="card-title">Editar Usuario</h3>
  </div>
  <form action="{{ route('users.update', $user) }}" method="POST">
    @csrf @method('PUT')
    <div class="card-body">
      <!-- Nombre -->
      <div class="form-group">
        <label>Nombre</label>
        <input type="text"
               name="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name',$user->name) }}"
               required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
      <!-- Email -->
      <div class="form-group">
        <label>Email</label>
        <input type="email"
               name="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email',$user->email) }}"
               required>
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
      <!-- Contraseña -->
      <div class="form-group">
        <label>Nueva Contraseña <small>(opcional)</small></label>
        <input type="password"
               name="password"
               class="form-control @error('password') is-invalid @enderror">
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
      <!-- Rol -->
      <div class="form-group">
        <label>Rol</label>
        <select name="role"
                class="form-control @error('role') is-invalid @enderror"
                required>
          @foreach($roles as $r)
            <option value="{{ $r }}"
              {{ old('role',$user->role) === $r ? 'selected' : '' }}>
              {{ ucfirst($r) }}
            </option>
          @endforeach
        </select>
        @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
    </div>
    <div class="card-footer">
      <button class="btn btn-primary">Actualizar</button>
      <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
  </form>
</div>
@stop
