@extends('layout')

@section('title', "Detalle de {$product->name}")

@section('content')
<div class="impact-container">
    <div class="page-header">
        <h1>Detalle del Producto</h1>
    </div>

    <div class="product-detail">
        <div class="product-detail-img">
            <img src="{{ $product->image_url }}" alt="Imagen de {{ $product->name }}">
        </div>
        <div class="product-detail-info">
            <h2>{{ $product->name }}</h2>
            <p>
                <strong>Descripción:</strong><br>
                {{ $product->description }}
            </p>
            <p>
                <strong>Precio:</strong> Bs {{ number_format($product->price, 2) }}
            </p>
            <p>
                <strong>Unidades en Stock:</strong> {{ $product->stock }}
            </p>
        </div>
    </div>

    <div class="form-footer">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Volver al Listado</a>
        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Editar</a>
    </div>
</div>
@stop