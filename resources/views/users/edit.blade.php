@extends('layout')

@section('title', 'Editar Usuario')

@section('content')
<div class="impact-container">
    <div class="page-header">
        <h1>Editar Usuario</h1>
    </div>

    <form action="{{ route('users.update', $user) }}" method="POST" class="impact-form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror" required>
        </div>
        @error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" required>
        </div>
        @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror

        <div class="form-group">
            <label>Nueva Contraseña</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Dejar en blanco para no cambiar">
        </div>
        @error('password') <div class="alert alert-danger">{{ $message }}</div> @enderror

        <div class="form-group">
            <label>Rol</label>
            <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                @foreach($roles as $r)
                    <option value="{{ $r }}" {{ old('role', $user->role) === $r ? 'selected' : '' }}>
                        {{ ucfirst($r) }}
                    </option>
                @endforeach
            </select>
        </div>
        @error('role') <div class="alert alert-danger">{{ $message }}</div> @enderror

        <div class="form-footer">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
        </div>
    </form>
</div>
@stop