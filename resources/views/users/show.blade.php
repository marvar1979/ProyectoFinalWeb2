@extends('layout')

@section('title', "Detalle del Usuario")

@section('content')
<div class="impact-container">
    <div class="page-header">
        <h1>Detalle del Usuario</h1>
    </div>

    <div class="product-detail-info" style="padding-left: 1rem;">
        <h2>{{ $user->name }}</h2>
        <p>
            <strong>ID de Usuario:</strong> {{ $user->id }}
        </p>
        <p>
            <strong>Email:</strong> {{ $user->email }}
        </p>
        <p>
            <strong>Rol:</strong> {{ ucfirst($user->role) }}
        </p>
    </div>

    <div class="form-footer">
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Volver al Listado</a>
        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Editar Usuario</a>
    </div>
</div>
@stop