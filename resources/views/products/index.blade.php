@extends('layout')

@section('title', 'Listado de Productos')

@section('content')
<div class="impact-container">
    <div class="page-header">
        <h1>Listado de Productos</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">+ Nuevo Producto</a>
    </div>

    <table class="impact-table">
        <thead>
            <tr>
                <th>ID</th>
                <th class="text-left">Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td class="text-left">{{ $p->name }}</td>
                <td>Bs {{ number_format($p->price, 2) }}</td>
                <td>{{ $p->stock }}</td>
                <td><img src="{{ $p->image_url }}" alt="Imagen de {{ $p->name }}" /></td>
                <td class="action-buttons">
                    <a href="{{ route('products.show', $p) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('products.edit', $p) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('products.destroy', $p) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este producto?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center" style="padding: 3rem; font-size: 1.2rem;">
                    No hay productos registrados.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@stop