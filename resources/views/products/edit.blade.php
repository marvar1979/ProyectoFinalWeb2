@extends('layout')

@section('title', "Editar Producto #{$product->id}")

@section('content_header')
    <h1>Editar Producto #{{ $product->id }}</h1>
@stop

@section('content')
<div class="card card-light">
  <div class="card-header">
    <h3 class="card-title">Editar Producto</h3>
  </div>
  <form action="{{ route('products.update',$product) }}" method="POST">
    @csrf @method('PUT')
    <div class="card-body">
      <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="name"
               value="{{ old('name',$product->name) }}"
               class="form-control"/>
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label>Descripción</label>
        <textarea name="description" class="form-control">{{ old('description',$product->description) }}</textarea>
        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Precio</label>
            <input type="number" step="0.01" name="price"
                   value="{{ old('price',$product->price) }}"
                   class="form-control"/>
            @error('price') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Stock</label>
            <input type="number" name="stock"
                   value="{{ old('stock',$product->stock) }}"
                   class="form-control"/>
            @error('stock') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
        </div>
      </div>
      <div class="form-group">
        <label>URL de la imagen</label>
        <input type="url" name="image_url"
               value="{{ old('image_url',$product->image_url) }}"
               class="form-control"/>
        @error('image_url') <small class="text-danger">{{ $message }}</small> @enderror
      </div>
    </div>
    <div class="card-footer">
      <button class="btn btn-primary">Actualizar</button>
      <a href="{{ route('products.show',$product) }}" class="btn btn-secondary">Cancelar</a>
    </div>
  </form>
</div>
@stop
