<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // — Métricas generales —
        $totalRevenue    = DB::table('sale_details')
            ->select(DB::raw('SUM(quantity * price) as total'))
            ->value('total') ?? 0;
        $totalSales      = DB::table('sales')->count();
        $uniqueCustomers = DB::table('sales')
            ->distinct('buyer_id')->count('buyer_id');
        $avgOrderValue   = $totalSales
            ? round($totalRevenue / $totalSales, 2)
            : 0;

        // — Ventas por canal (revenue) —
        $salesByChannel = DB::table('sales as s')
            ->join('sale_details as sd','s.id','=','sd.sale_id')
            ->select('s.buyer_type', DB::raw('SUM(sd.quantity * sd.price) as total'))
            ->groupBy('s.buyer_type')
            ->pluck('total','buyer_type')
            ->toArray();
        $ventasCajeros  = $salesByChannel['cajero']  ?? 0;
        $ventasWeb      = $salesByChannel['cliente'] ?? 0;

        // — Cantidad de ventas por canal (count) —
        $countByChannel = DB::table('sales')
            ->select('buyer_type', DB::raw('COUNT(*) as cnt'))
            ->groupBy('buyer_type')
            ->pluck('cnt','buyer_type')
            ->toArray();
        $countCajeros   = $countByChannel['cajero']  ?? 0;
        $countClientes  = $countByChannel['cliente'] ?? 0;

        // — Total de ítems vendidos —
        $totalItemsSold = DB::table('sale_details')
            ->sum('quantity');

        // — Producto más vendido (por cantidad) —
        $topProductQty = DB::table('sale_details as sd')
            ->join('products as p','sd.product_id','=','p.id')
            ->select('p.name', DB::raw('SUM(sd.quantity) as qty'))
            ->groupBy('p.id','p.name')
            ->orderByDesc('qty')
            ->first();

        // — Top 5 productos por ingreso (revenue) —
        $topProducts = DB::table('sale_details as sd')
            ->join('products as p','sd.product_id','=','p.id')
            ->select('p.name', DB::raw('SUM(sd.quantity * sd.price) as revenue'))
            ->groupBy('p.id','p.name')
            ->orderByDesc('revenue')
            ->limit(5)
            ->get();

        // — Evolución diaria últimos 7 días —
        $start = Carbon::today()->subDays(6)->startOfDay();
        $salesOverTime = DB::table('sales as s')
            ->join('sale_details as sd','s.id','=','sd.sale_id')
            ->where('s.sale_date','>=',$start)
            ->select(
              DB::raw("DATE(s.sale_date) as date"),
              DB::raw('SUM(sd.quantity * sd.price) as revenue')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // — Últimas 5 ventas —
        $recentSales = DB::table('sales as s')
            ->join('users as u','s.buyer_id','=','u.id')
            ->join('sale_details as sd','s.id','=','sd.sale_id')
            ->select(
              's.id as sale_id',
              's.sale_date',
              'u.name as buyer_name',
              's.buyer_type',
              DB::raw('SUM(sd.quantity * sd.price) as total')
            )
            ->groupBy('s.id','s.sale_date','u.name','s.buyer_type')
            ->orderByDesc('s.sale_date')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
          'totalRevenue','totalSales','uniqueCustomers','avgOrderValue',
          'ventasCajeros','ventasWeb','countCajeros','countClientes',
          'totalItemsSold','topProductQty',
          'topProducts','salesOverTime','recentSales'
        ));
    }
}
