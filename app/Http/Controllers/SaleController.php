<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{


    /* === Listar ventas === */
    public function index()
{
    // Ventas completas con comprador y detalles
    $query = Sale::with(['buyer', 'details'])
                 ->orderBy('sale_date', 'desc');

    if (! auth()->user()->isAdmin()) {
        $query->where('buyer_id', auth()->id());
    }

    $sales = $query->get();

    // Subconsulta para últimas 5 ventas con total
    $totalSales = DB::table('sales')
    ->join('users', 'sales.buyer_id', '=', 'users.id')
    ->join('sale_details', 'sales.id', '=', 'sale_details.sale_id')
    ->select(
        'sales.id as sale_id',
        'sales.sale_date',
        'sales.buyer_type',
        'users.name as buyer_name',
        DB::raw('SUM(COALESCE(sale_details.quantity,0) * COALESCE(sale_details.price,0)) as total')
    )
    ->groupBy('sales.id', 'sales.sale_date', 'sales.buyer_type', 'users.name')
    ->orderBy('sales.sale_date', 'desc')
    ->take(5)
    ->get();


    return view('sales.index', compact('sales', 'totalSales'));
}

public function indexC()
{
    // Ventas completas con comprador y detalles
    $query = Sale::with(['buyer', 'details'])
                 ->orderBy('sale_date', 'desc');

    if (! auth()->user()->isAdmin()) {
        $query->where('buyer_id', auth()->id());
    }

    $sales = $query->get();

    // Subconsulta para últimas 5 ventas con total
    $totalSales = DB::table('sales')
    ->join('users', 'sales.buyer_id', '=', 'users.id')
    ->join('sale_details', 'sales.id', '=', 'sale_details.sale_id')
    ->select(
        'sales.id as sale_id',
        'sales.sale_date',
        'sales.buyer_type',
        'users.name as buyer_name',
        DB::raw('SUM(COALESCE(sale_details.quantity,0) * COALESCE(sale_details.price,0)) as total')
    )
    ->groupBy('sales.id', 'sales.sale_date', 'sales.buyer_type', 'users.name')
    ->orderBy('sales.sale_date', 'desc')
    ->take(5)
    ->get();


    return view('sales.indexC', compact('sales', 'totalSales'));
}
    /* === Formulario para crear venta === */
    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('sales.create', compact('products'));
    }

    /* === Guardar la venta completa (cabecera + detalles) === */
    public function store(Request $request)
    {
        $data = $request->validate([
            'items'                => 'required|array',
            'items.*.product_id'   => 'required|exists:products,id',
            'items.*.quantity'     => 'required|integer|min:1',
        ]);

        DB::transaction(function() use ($data) {
            $buyer = auth()->user();

            $sale = Sale::create([
                'buyer_id'   => $buyer->id,
                'buyer_type' => $buyer->isCashier() ? 'cajero' : 'cliente',
                'sale_date'  => now(),
            ]);

            foreach ($data['items'] as $item) {
                $product = Product::lockForUpdate()->find($item['product_id']);

                abort_if(
                    $product->stock < $item['quantity'],
                    409,
                    "Stock insuficiente en {$product->name}"
                );

                $product->decrement('stock', $item['quantity']);

                SaleDetail::create([
                    'sale_id'    => $sale->id,
                    'product_id' => $product->id,
                    'quantity'   => $item['quantity'],
                    'price'      => $product->price,
                ]);
            }
        });

        return redirect()
            ->route('sales.index')
            ->with('ok', 'Venta realizada con éxito');
    }

    /* === Mostrar venta === */
    public function show(Sale $sale)
    {
        // Política de acceso (opcional)
        $this->authorize('view', $sale);

        // Eager-load de detalles y producto para el detalle
        $sale->load(['details.product', 'buyer']);

        return view('sales.show', compact('sale'));
    }
}
