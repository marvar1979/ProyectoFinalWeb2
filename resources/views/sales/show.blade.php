@extends('layout')

@section('title', "Venta #{$sale->id}")

@push('styles')
<link href="{{ asset('css/dash.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="impact-container">
    <div class="page-header">
        <h1>Venta #{{ $sale->id }}</h1>
    </div>

    <div class="product-detail">
        <div class="product-detail-info">
            <p><strong>Fecha:</strong>
               {{ \Carbon\Carbon::parse($sale->sale_date)->format('Y-m-d H:i') }}
            </p>
            <p><strong>Comprador:</strong> {{ $sale->buyer->name }}</p>
            <p><strong>Canal:</strong>
               {{ $sale->buyer_type === 'cajero' ? 'Tienda Física' : 'Cliente Web' }}
            </p>
            <p><strong>Total de Venta:</strong>
               Bs {{ number_format($sale->total,2) }}
            </p>
        </div>
    </div>

    <h3 style="margin-top:2rem;">Detalle de Productos</h3>
    <table class="impact-table">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Precio Unitario (Bs)</th>
          <th>Subtotal (Bs)</th>
        </tr>
      </thead>
      <tbody>
        @foreach($sale->details as $d)
        <tr>
          <td data-label="Producto" class="text-left">{{ $d->product->name }}</td>
          <td data-label="Cantidad">{{ $d->quantity }}</td>
          <td data-label="Precio Unit.">Bs {{ number_format($d->price,2) }}</td>
          <td data-label="Subtotal">
            Bs {{ number_format($d->quantity * $d->price,2) }}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>
@stop
