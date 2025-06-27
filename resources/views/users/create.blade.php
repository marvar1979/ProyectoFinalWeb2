@extends('layout')

@section('title', 'Crear Usuario')

@section('content')
<div class="impact-container">
    <div class="page-header">
        <h1>Crear Nuevo Usuario</h1>
    </div>

    <form action="{{ route('users.store') }}" method="POST" class="impact-form">
        @csrf
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
        </div>
        @error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
        </div>
        @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror

        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
        </div>
        @error('password') <div class="alert alert-danger">{{ $message }}</div> @enderror

        <div class="form-group">
            <label>Rol</label>
            <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                <option value="" disabled selected>Selecciona un rol</option>
                @foreach($roles as $r)
                    <option value="{{ $r }}" {{ old('role') === $r ? 'selected' : '' }}>
                        {{ ucfirst($r) }}
                    </option>
                @endforeach
            </select>
        </div>
        @error('role') <div class="alert alert-danger">{{ $message }}</div> @enderror

        <div class="form-footer">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar Usuario</button>
        </div>
    </form>
</div>
@stop