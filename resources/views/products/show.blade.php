@extends('layout')

@section('title', "Producto #{$product->id}")

@section('content_header')
    <h1>Producto #{{ $product->id }}</h1>
@stop

@section('content')
<div class="card card-light">
  <div class="card-header">
    <h3 class="card-title">{{ $product->name }}</h3>
  </div>
  <div class="card-body">
    <p><strong>Descripción:</strong> {{ $product->description }}</p>
    <p><strong>Precio:</strong> Bs {{ number_format($product->price,2) }}</p>
    <p><strong>Stock:</strong> {{ $product->stock }}</p>
    <p><strong>Imagen:</strong><br>
       <img src="{{ $product->image_url }}" width="150"/>
    </p>
  </div>
  <div class="card-footer">
    <a href="{{ route('products.edit',$product) }}" class="btn btn-warning">Editar</a>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Volver</a>
  </div>
</div>
@stop
