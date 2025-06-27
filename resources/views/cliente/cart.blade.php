@extends('layouts.cliente')

@section('title','Tu Carrito')

@section('content')
<div class="container">
  <h1 class="text-center mb-4">🛒 Tu Carrito</h1>

  @if(empty($cart))
    <div class="text-center">
      <p class="lead">Tu carrito de compras está actualmente vacío.</p>
      <a href="{{ route('cliente.home') }}" class="btn btn-primary">Explorar Libros</a>
    </div>
  @else
    <form method="POST" action="{{ route('cliente.cart.update') }}">
      @csrf
      <table class="table table-striped">
        <thead>
          <tr><th>Libro</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th></tr>
        </thead>
        <tbody>
        @php $total=0; @endphp
        @foreach($cart as $item)
          @php $sub=$item['qty']*$item['price']; $total+=$sub; @endphp
          <tr>
            <td>{{ $item['name'] }}</td>
            <td>Bs {{ number_format($item['price'],2) }}</td>
            <td>
              <input type="number" min="0" name="items[][quantity]" value="{{ $item['qty'] }}" class="form-control" style="width:90px;display:inline">
              <input type="hidden" name="items[][id]" value="{{ $item['id'] }}">
            </td>
            <td>Bs {{ number_format($sub,2) }}</td>
          </tr>
        @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th colspan="3" class="text-end">Total</th>
            <th>Bs {{ number_format($total,2) }}</th>
          </tr>
        </tfoot>
      </table>

      <div class="d-flex justify-content-between">
        <a href="{{ route('cliente.home') }}" class="btn btn-secondary">Seguir Comprando</a>
        <div>
          <button class="btn btn-warning">Actualizar Carrito</button>
          <button formaction="{{ route('cliente.cart.checkout') }}" class="btn btn-success">Pagar</button>
        </div>
      </div>
    </form>
  @endif
</div>
@endsection
