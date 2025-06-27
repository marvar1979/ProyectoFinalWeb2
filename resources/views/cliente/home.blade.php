@extends('layouts.cliente')

@section('title','Catálogo de Libros')

@section('content')
<div class="container">
  <h1 class="text-center mb-4">Catálogo de Libros</h1>

  <form class="row mb-4" method="GET">
    <div class="col-md-8">
      <input name="q" value="{{ $q }}" class="form-control" placeholder="Buscar libro…">
    </div>
    <div class="col-md-4 d-grid">
      <button class="btn btn-primary">Buscar</button>
    </div>
  </form>

  <div class="row g-4">
  @forelse($products as $p)
    <div class="col-sm-6 col-md-4">
      <div class="card h-100">
        <img src="{{ $p->image_url }}" class="card-img-top" alt="{{ $p->name }}">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">{{ $p->name }}</h5>
          <p class="card-text mb-1"><strong>Bs {{ number_format($p->price,2) }}</strong></p>
          <p class="card-text text-muted mb-3">Stock: {{ $p->stock }}</p>
          <form method="POST" action="{{ route('cliente.cart.add') }}" class="mt-auto">
            @csrf
            <input type="hidden" name="product_id" value="{{ $p->id }}">
            <input type="hidden" name="qty" value="1">
            <button class="btn btn-success w-100">Añadir al carrito</button>
          </form>
        </div>
      </div>
    </div>
  @empty
    <p class="text-center">No se encontraron libros.</p>
  @endforelse
  </div>
</div>
@endsection
