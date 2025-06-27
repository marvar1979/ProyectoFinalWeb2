<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /* Mostrar carrito */
    public function show()
    {
        $cart = session('cart', []);
        return view('cliente.cart', ['cart' => $cart]);
    }

    /* Añadir producto */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty'        => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        $cart = session('cart', []);
        $key  = (string) $product->id;

        $cart[$key] = [
            'id'       => $product->id,
            'name'     => $product->name,
            'price'    => $product->price,
            'qty'      => ($cart[$key]['qty'] ?? 0) + $request->qty,
        ];

        session(['cart' => $cart]);

        return back()->with('ok', 'Libro agregado al carrito');
    }

    /* Actualizar cantidades */
    public function update(Request $request)
    {
        $items = $request->validate([
            'items'            => 'required|array',
            'items.*.id'       => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:0',
        ]);

        $cart = [];
        foreach ($items['items'] as $it) {
            if ($it['quantity'] > 0) {
                $p = Product::find($it['id']);
                $cart[(string)$p->id] = [
                    'id'    => $p->id,
                    'name'  => $p->name,
                    'price' => $p->price,
                    'qty'   => $it['quantity'],
                ];
            }
        }
        session(['cart' => $cart]);
        return back()->with('ok', 'Carrito actualizado');
    }

    /* Checkout – crea registro en sales */
    public function checkout()
    {
        $cart = session('cart', []);

        abort_if(empty($cart), 400, 'El carrito está vacío');

        DB::transaction(function () use ($cart) {
            $buyer = auth()->user(); // o visitor anónimo si no exiges login

            $sale = Sale::create([
                'buyer_id'   => $buyer?->id,
                'buyer_type' => 'usuario',
                'sale_date'  => now(),
            ]);

            foreach ($cart as $item) {
                $product = Product::lockForUpdate()->find($item['id']);

                abort_if($product->stock < $item['qty'], 409,
                    "Stock insuficiente en {$product->name}");

                $product->decrement('stock', $item['qty']);

                SaleDetail::create([
                    'sale_id'    => $sale->id,
                    'product_id' => $product->id,
                    'quantity'   => $item['qty'],
                    'price'      => $product->price,
                ]);
            }
        });

        session()->forget('cart');
        return redirect()->route('cliente.home')->with('ok', '¡Compra realizada!');
    }
}
