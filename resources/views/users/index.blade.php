@extends('layout')

@section('title', 'Gestión de Usuarios')

@section('content')
<div class="impact-container">
    <div class="page-header">
        <h1>Gestión de Usuarios</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary">+ Nuevo Usuario</a>
    </div>

    <div class="filter-card">
        <h3>Filtros de Búsqueda</h3>
        <form action="{{ route('users.index') }}" method="GET" class="filter-form">
            <div class="filter-group">
                <label for="search">Buscar:</label>
                <input type="text" id="search" name="search" class="form-control" placeholder="Nombre o email..." value="{{ old('search', $filter['search'] ?? '') }}">
            </div>
            <div class="filter-group">
                <label for="role">Rol:</label>
                <select id="role" name="role" class="form-control">
                    <option value="">Todos los roles</option>
                    @foreach($roles as $r)
                        <option value="{{ $r }}" {{ (old('role', $filter['role'] ?? '') === $r) ? 'selected' : '' }}>
                            {{ ucfirst($r) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Reset</a>
        </form>
    </div>


    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <table class="impact-table">
        <thead>
            <tr>
                <th>ID</th>
                <th class="text-left">Nombre</th>
                <th class="text-left">Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $u)
            <tr>
                <td>{{ $u->id }}</td>
                <td class="text-left">{{ $u->name }}</td>
                <td class="text-left">{{ $u->email }}</td>
                <td>{{ ucfirst($u->role) }}</td>
                <td class="action-buttons">
                    <a href="{{ route('users.show', $u) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('users.edit', $u) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('users.destroy', $u) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este usuario?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center" style="padding: 3rem; font-size: 1.2rem;">
                    No se encontraron usuarios con los criterios de búsqueda.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if ($users->hasPages())
    <div class="card-footer clearfix mt-4">
        {{ $users->links() }}
    </div>
    @endif
</div>
@stop