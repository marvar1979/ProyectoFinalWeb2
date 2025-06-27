@extends('layout')

@section('title', 'Listado de Ventas')

@push('styles')
<link href="{{ asset('css/dash.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="impact-container">
    <div class="page-header">
        <h1>Listado de Ventas</h1>
    </div>

    {{-- Ventas recientes --}}
  <div class="dashboard-table">
    <div class="card">
      <div class="card-header">Últimas 5 Ventas</div>
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>ID</th><th>Fecha</th><th>Comprador</th><th>Canal</th><th>Total (Bs)</th>
            </tr>
          </thead>
          <tbody>
            @foreach($totalSales as $sale)
              <tr>
                <td>{{ $sale->sale_id }}</td>
                <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('Y-m-d H:i') }}</td>
                <td>{{ $sale->buyer_name }}</td>
                <td>{{ ucfirst($sale->buyer_type) }}</td>
                <td>{{ number_format($sale->total,2) }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@stop
