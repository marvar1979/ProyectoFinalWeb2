<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Eliminamos el __construct para no exigir auth por ahora

    // Listado de productos
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Formulario de creación
    public function create()
    {
        return view('products.create');
    }

    // Guarda un nuevo producto
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image_url'   => 'required|url',
        ]);

        Product::create($data);

        return redirect()
            ->route('products.index')
            ->with('ok', 'Producto creado');
    }

    // Muestra un producto
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Formulario de edición
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Actualiza un producto existente
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image_url'   => 'required|url',
        ]);

        $product->update($data);

        return back()->with('ok', 'Actualizado');
    }

    // Elimina un producto
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('ok', 'Eliminado');
    }
}
