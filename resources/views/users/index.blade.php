@extends('layout')

@section('content_header')
    <h1 class="m-0 text-dark">Usuarios</h1>
@stop

@section('content')
<div class="card card-light">
  <div class="card-header">
    <h3 class="card-title">Listado de Usuarios</h3>
    <div class="card-tools d-flex">
      <!-- Filtro y búsqueda -->
      <form action="{{ route('users.index') }}" method="GET" class="form-inline mr-2">
        <div class="input-group input-group-sm">
          <select name="role" class="form-control">
            <option value="">Todos los roles</option>
            @foreach($roles as $r)
              <option value="{{ $r }}"
                {{ (old('role',$filter['role'] ?? '') === $r) ? 'selected' : '' }}>
                {{ ucfirst($r) }}
              </option>
            @endforeach
          </select>
          <input type="text"
                 name="search"
                 class="form-control"
                 placeholder="Buscar..."
                 value="{{ old('search',$filter['search'] ?? '') }}">
          <div class="input-group-append">
            <button class="btn btn-default"><i class="fas fa-search"></i></button>
          </div>
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm ml-2">Reset</a>
      </form>
      <!-- Botón Nuevo -->
      <a href="{{ route('users.create') }}" class="btn btn-success btn-sm">+ Nuevo Usuario</a>
    </div>
  </div>

  <div class="card-body p-0 table-responsive">
    @if(session('success'))
      <div class="alert alert-success m-3">{{ session('success') }}</div>
    @endif

    <table class="table table-hover table-bordered mb-0">
      <thead class="thead-light">
        <tr>
          <th style="width: 50px;">ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Rol</th>
          <th style="width:180px">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $u)
        <tr>
          <td>{{ $u->id }}</td>
          <td>{{ $u->name }}</td>
          <td>{{ $u->email }}</td>
          <td>{{ ucfirst($u->role) }}</td>
          <td>
            <a href="{{ route('users.show',  $u) }}" class="btn btn-info btn-sm">Ver</a>
            <a href="{{ route('users.edit',  $u) }}" class="btn btn-warning btn-sm">Editar</a>
            <form action="{{ route('users.destroy', $u) }}"
                  method="POST"
                  class="d-inline"
                  onsubmit="return confirm('¿Eliminar este usuario?')">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm">Eliminar</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="text-center">No hay usuarios</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="card-footer clearfix">
    {{ $users->links() }}
  </div>
</div>
@stop
