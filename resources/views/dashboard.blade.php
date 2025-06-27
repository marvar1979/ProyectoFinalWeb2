@extends('layout')

@section('title', 'Dashboard de Ventas')

@push('styles')
<link href="{{ asset('css/dash.css') }}" rel="stylesheet">
@endpush

@section('content_header')
  <h2>Dashboard de Ventas</h2>
@stop

@section('content')
<div class="dashboard-container">
  {{-- Métricas clave --}}
  <div class="dashboard-metrics">
    <div class="dashboard-metric">
      <h5>Total Ingresos</h5>
      <p class="display-4">Bs {{ number_format($totalRevenue,2) }}</p>
    </div>
    <div class="dashboard-metric">
      <h5>Total Ventas</h5>
      <p class="display-4">{{ $totalSales }}</p>
    </div>
    <div class="dashboard-metric">
      <h5>Valor Promedio</h5>
      <p class="display-4">Bs {{ number_format($avgOrderValue,2) }}</p>
    </div>
    <div class="dashboard-metric">
      <h5>Clientes Únicos</h5>
      <p class="display-4">{{ $uniqueCustomers }}</p>
    </div>
    <div class="dashboard-metric">
      <h5>Ventas Cajero</h5>
      <p class="display-4">{{ $countCajeros }}</p>
    </div>
    <div class="dashboard-metric">
      <h5>Ventas Web</h5>
      <p class="display-4">{{ $countClientes }}</p>
    </div>
    <div class="dashboard-metric">
      <h5>Ítems Vendidos</h5>
      <p class="display-4">{{ $totalItemsSold }}</p>
    </div>
    <div class="dashboard-metric">
      <h5>Top Producto</h5>
      <p class="mb-1">{{ $topProductQty->name }}</p>
      <small>{{ $topProductQty->qty }} unidades</small>
    </div>
  </div>

  {{-- Gráficos --}}
  <div class="dashboard-charts">
    <div class="card">
      <div class="card-header">Ventas por Canal (Bs)</div>
      <div class="card-body">
        <canvas id="chartChannel"></canvas>
      </div>
    </div>
    <div class="card">
      <div class="card-header">Top 5 Productos (Bs)</div>
      <div class="card-body">
        <canvas id="chartTopProducts"></canvas>
      </div>
    </div>
    <div class="card">
      <div class="card-header">Ingresos Últimos 7 Días</div>
      <div class="card-body">
        <canvas id="chartSalesTime"></canvas>
      </div>
    </div>
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
            @foreach($recentSales as $sale)
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  // Obtenemos valores de CSS custom properties
  const rootStyles = getComputedStyle(document.documentElement);
  const gold   = rootStyles.getPropertyValue('--accent-gold').trim();
  const dark   = rootStyles.getPropertyValue('--color-dark').trim();
  const medium = rootStyles.getPropertyValue('--color-medium').trim();

  // Ventas por canal (Pie) con alto contraste
  new Chart(
    document.getElementById('chartChannel').getContext('2d'),
    {
      type: 'pie',
      data: {
        labels: ['Cajero','Cliente Web'],
        datasets: [{
          data: [{{ $ventasCajeros }}, {{ $ventasWeb }}],
          backgroundColor: [ gold, dark ],
          borderColor:     [ dark, medium ],
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            labels: {
              color: rootStyles.getPropertyValue('--color-dark').trim()
            }
          }
        }
      }
    }
  );

  // Top 5 productos (Bar)
  new Chart(
    document.getElementById('chartTopProducts').getContext('2d'),
    {
      type: 'bar',
      data: {
        labels: {!! json_encode($topProducts->pluck('name')) !!},
        datasets: [{
          label: 'Bs',
          data: {!! json_encode($topProducts->pluck('revenue')) !!},
          backgroundColor: gold,
          borderColor:     dark,
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: { color: dark },
            grid:  { color: rootStyles.getPropertyValue('--border-color').trim() }
          },
          x: {
            ticks: { color: dark },
            grid:  { display: false }
          }
        },
        plugins: {
          legend: {
            display: false
          }
        }
      }
    }
  );

  // Ingresos últimos 7 días (Line)
  new Chart(
    document.getElementById('chartSalesTime').getContext('2d'),
    {
      type: 'line',
      data: {
        labels: {!! json_encode($salesOverTime->pluck('date')) !!},
        datasets: [{
          label: 'Bs',
          data: {!! json_encode($salesOverTime->pluck('revenue')) !!},
          fill: true,
          tension: 0.3,
          borderColor: dark,
          backgroundColor: 'rgba(255,215,0,0.2)' // semitransparente dorado
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: { color: dark },
            grid:  { color: rootStyles.getPropertyValue('--border-color').trim() }
          },
          x: {
            ticks: { color: dark },
            grid:  { display: false }
          }
        },
        plugins: {
          legend: {
            display: false
          }
        }
      }
    }
  );
});
</script>
@endpush
