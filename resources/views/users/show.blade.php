@extends('layout')

@section('content_header')
    <h1 class="m-0 text-dark">Detalle Usuario #{{ $user->id }}</h1>
@stop

@section('content')
<div class="card card-light">
  <div class="card-header">
    <h3 class="card-title">{{ $user->name }}</h3>
  </div>
  <div class="card-body">
    <p><strong>ID:</strong>    {{ $user->id }}</p>
    <p><strong>Nombre:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong>  {{ $user->email }}</p>
    <p><strong>Rol:</strong>    {{ ucfirst($user->role) }}</p>
  </div>
  <div class="card-footer">
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Volver</a>
    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Editar</a>
  </div>
</div>
@stop
