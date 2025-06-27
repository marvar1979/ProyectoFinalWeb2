@extends('layout')

@section('title', 'Listado de Productos')

@section('content_header')
    <h1 class="m-0 text-dark">Listado de Productos</h1>
@stop

@section('content')
<div class="card card-light">
  <div class="card-header">
    <h3 class="card-title">Productos</h3>
    <div class="card-tools">
      <a href="{{ route('products.create') }}" class="btn btn-success btn-sm">+ Nuevo</a>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <thead>
        <tr>
          <th>ID</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Imagen</th><th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($products as $p)
        <tr>
          <td>{{ $p->id }}</td>
          <td>{{ $p->name }}</td>
          <td>{{ number_format($p->price,2) }}</td>
          <td>{{ $p->stock }}</td>
          <td><img src="{{ $p->image_url }}" width="50"/></td>
          <td>
            <a href="{{ route('products.show',$p) }}"   class="btn btn-info btn-sm">Ver</a>
            <a href="{{ route('products.edit',$p) }}"   class="btn btn-warning btn-sm">Editar</a>
            <form action="{{ route('products.destroy',$p) }}" method="POST" style="display:inline">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm"
                      onclick="return confirm('¿Eliminar este producto?')">
                Eliminar
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center">Sin registros</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div>
@stop
