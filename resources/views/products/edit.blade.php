{{-- resources/views/products/edit.blade.php --}}
@extends('layout')

@section('title', 'Editar Producto')

@push('styles')
<link href="{{ asset('css/vintage.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="impact-container" style="max-width: 600px;">
    <div class="page-header">
        <h1>Editar Producto</h1>
    </div>

    <form action="{{ route('products.update', $product) }}"
          method="POST"
          class="impact-form"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nombre</label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $product->name) }}"
                   class="form-control"/>
            @error('name')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Descripción</label>
            <textarea name="description"
                      class="form-control"
                      rows="4">{{ old('description', $product->description) }}</textarea>
            @error('description')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Precio</label>
            <input type="number"
                   step="0.01"
                   name="price"
                   value="{{ old('price', $product->price) }}"
                   class="form-control"/>
            @error('price')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Stock</label>
            <input type="number"
                   name="stock"
                   value="{{ old('stock', $product->stock) }}"
                   class="form-control"/>
            @error('stock')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Preview de la imagen actual --}}
        <div class="form-group">
            <label>Imagen Actual</label>
            <div class="product-detail-img">
                <img src="{{ asset($product->image_url) }}"
                     alt="Imagen de {{ $product->name }}"
                     style="max-width: 200px; border:1px solid var(--border-color); padding:4px;"/>
            </div>
        </div>

        {{-- Input de archivo --}}
        <div class="form-group">
            <label>Actualizar Imagen</label>
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
                    Subir Nueva Imagen
                </button>
                <span id="file-name" style="margin-left:1rem;">
                    {{ old('image') ? old('image') : basename($product->image_url) }}
                </span>
            </div>
            @error('image')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-footer">
            <a href="{{ route('products.index') }}"
               class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">
                Actualizar Cambios
            </button>
        </div>
    </form>
</div>
@endsection
