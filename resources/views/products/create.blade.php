@extends('layout')

@section('title', 'Crear Producto')

@section('content')
<div class="impact-container">
    <div class="page-header">
        <h1>Crear Nuevo Producto</h1>
    </div>

    <form action="{{ route('products.store') }}"
          method="POST"
          class="impact-form"
          enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Nombre</label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   class="form-control"/>
            @error('name')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Descripción</label>
            <textarea name="description"
                      class="form-control">{{ old('description') }}</textarea>
            @error('description')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Precio</label>
            <input type="number"
                   step="0.01"
                   name="price"
                   value="{{ old('price') }}"
                   class="form-control"/>
            @error('price')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Stock</label>
            <input type="number"
                   name="stock"
                   value="{{ old('stock') }}"
                   class="form-control"/>
            @error('stock')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Imagen del producto</label>
            <div>
                <input type="file"
                       name="image"
                       id="image"
                       accept="image/*"
                       style="display:none;"
                       onchange="document.getElementById('file-name').textContent = this.files[0]?.name || 'No se ha seleccionado archivo'">
                <button type="button"
                        class="btn btn-primary"
                        onclick="document.getElementById('image').click()">
                    Subir Imagen
                </button>
                <span id="file-name" style="margin-left:1rem;">
                    {{ old('image') ? old('image') : 'No se ha seleccionado archivo' }}
                </span>
            </div>
            @error('image')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-footer">
            <a href="{{ route('products.index') }}"
               class="btn btn-secondary">
               Cancelar
            </a>
            <button type="submit"
                    class="btn btn-primary">
                Guardar Producto
            </button>
        </div>
    </form>
</div>
@stop
