@extends('layoutCaj')

@section('title', 'Punto de Venta – Cajero')

@push('styles')
<link href="{{ asset('css/dash.css') }}" rel="stylesheet">
<style>
/* Controles + / – */
.qty-control      { display:flex; align-items:center; gap:.5rem; }
.qty-control button{
  width:32px;height:32px; border:2px solid var(--color-medium);
  background:transparent; color:var(--color-medium);
  font-weight:bold; border-radius:6px; transition:.2s;
}
.qty-control button:hover{ background:var(--color-medium); color:#fff; }
.qty-input{ width:60px; text-align:center; border:1px solid var(--border-color);
  border-radius:6px; padding:6px; background:#fff; }
</style>
@endpush

@section('content')
<div class="impact-container">
  <div class="page-header">
      <h1>Punto de Venta (Libros)</h1>
  </div>

  {{-- Filtro de búsqueda --}}
  <div class="filter-card">
      <h3>Buscar Producto</h3>
      <form method="GET" action="{{ route('sales.create') }}" class="filter-form">
          <div class="filter-group">
              <label for="q">Nombre:</label>
              <input id="q" name="q" class="form-control"
                     value="{{ request('q') }}" placeholder="Buscar libro…">
          </div>
          <button class="btn btn-primary">Filtrar</button>
          <a href="{{ route('sales.create') }}" class="btn btn-secondary">Reset</a>
      </form>
  </div>

  {{-- Formulario de venta --}}
  <form method="POST" action="{{ route('sales.store') }}" id="saleForm">
      @csrf
      <table class="impact-table">
          <thead>
              <tr>
                  <th>ID</th><th class="text-left">Nombre</th>
                  <th>Precio (Bs)</th><th>Stock</th><th>Cantidad</th>
              </tr>
          </thead>
          <tbody>
              @forelse($products as $p)
              <tr>
                  <td>{{ $p->id }}</td>
                  <td class="text-left">{{ $p->name }}</td>
                  <td>{{ number_format($p->price,2) }}</td>
                  <td>{{ $p->stock }}</td>
                  <td>
                       <div class="qty-control"
                            data-product='@json(["id"=>$p->id,"price"=>$p->price])'>
                           <button type="button" class="btn-minus">−</button>
                           <input type="text" value="0" class="qty-input" readonly>
                           <button type="button" class="btn-plus">+</button>
                       </div>
                  </td>
              </tr>
              @empty
              <tr>
                  <td colspan="5" class="text-center" style="padding:3rem;">
                      No hay stock disponible.
                  </td>
              </tr>
              @endforelse
          </tbody>
      </table>

      <div class="form-footer">
          <button type="submit" class="btn btn-primary">Cobrar</button>
          <a href="{{ route('sales.index') }}" class="btn btn-secondary">Cancelar</a>
      </div>
  </form>
</div>
@stop

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  // Manejar + / −
  document.querySelectorAll('.qty-control').forEach(ctrl => {
     const minus = ctrl.querySelector('.btn-minus');
     const plus  = ctrl.querySelector('.btn-plus');
     const input = ctrl.querySelector('.qty-input');
     const data  = JSON.parse(ctrl.dataset.product);
     minus.addEventListener('click', () => {
        let v = +input.value; if (v>0) input.value = v-1;
     });
     plus.addEventListener('click', () => {
        let v = +input.value; input.value = v+1;
     });
  });

  // Al enviar, construimos items[] dinámicamente
  document.getElementById('saleForm').addEventListener('submit', e => {
     // eliminar inputs previos
     document.querySelectorAll('.item-hidden').forEach(el => el.remove());

     let items = [];
     document.querySelectorAll('.qty-control').forEach(ctrl => {
         const qty = +ctrl.querySelector('.qty-input').value;
         if (qty>0){
             const prod = JSON.parse(ctrl.dataset.product);
             items.push({product_id: prod.id, quantity: qty});
         }
     });
     if(items.length===0){
        e.preventDefault();
        alert('Seleccione al menos un libro.');
        return;
     }
     // inyectar campos ocultos
     items.forEach((it,idx)=>{
        ['product_id','quantity'].forEach(k=>{
          const inp=document.createElement('input');
          inp.type='hidden'; inp.name=`items[${idx}][${k}]`;
          inp.value=it[k]; inp.className='item-hidden';
          e.target.appendChild(inp);
        });
     });
  });
});
</script>
@endpush
