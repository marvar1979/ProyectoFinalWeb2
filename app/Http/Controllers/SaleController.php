<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');          // usuario o cajero
    }

    /* === Listar ventas === */
    public function index()
    {
        $sales = auth()->user()->isAdmin()
            ? Sale::with('buyer')->latest()->get()
            : Sale::where('buyer_id', auth()->id())->latest()->get();

        return view('sales.index', compact('sales'));
    }

    /* === Formulario para crear venta === */
    public function create()
    {
        $products = Product::where('stock','>',0)->get();
        return view('sales.create', compact('products'));
    }

    /* === Guardar la venta completa (cabecera + detalles) === */
    public function store(Request $request)
    {
        $data = $request->validate([
            'items'   => 'required|array',           // [ [id, qty], ... ]
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity'   => 'required|integer|min:1'
        ]);

        DB::transaction(function() use ($data) {
            $buyer          = auth()->user();
            $sale           = Sale::create([
                'buyer_id'   => $buyer->id,
                'buyer_type' => $buyer->isCashier() ? 'cajero' : 'usuario',
                'sale_date'  => now(),
            ]);

            foreach ($data['items'] as $item) {
                $product = Product::lockForUpdate()->find($item['product_id']);

                if ($product->stock < $item['quantity'])
                    abort(409, "Stock insuficiente en {$product->name}");

                $product->decrement('stock', $item['quantity']);

                SaleDetail::create([
                    'sale_id'    => $sale->id,
                    'product_id' => $product->id,
                    'quantity'   => $item['quantity'],
                    'price'      => $product->price
                ]);
            }
        });

        return redirect()->route('sales.index')->with('ok','Venta realizada');
    }

    /* === Mostrar venta === */
    public function show(Sale $sale)
    {
        $this->authorize('view', $sale); // Política opcional
        return view('sales.show', $sale->load('details.product', 'buyer'));
    }

    /* Métodos edit / update / destroy → opcionales (p. ej. devolver/cancelar venta) */
}
