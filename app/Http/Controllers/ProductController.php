<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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

    // Guarda un nuevo producto, subiendo la imagen a public/img
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'required|image|max:2048',
        ]);

        // Subida del archivo
        if ($file = $request->file('image')) {
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('img'), $filename);
            $data['image_url'] = 'img/' . $filename;
        }

        Product::create($data);

        return redirect()
            ->route('products.index')
            ->with('ok', 'Producto creado correctamente');
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

    // Actualiza un producto existente, con opción de cambiar imagen
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|max:2048',
        ]);

        // Si se sube nueva imagen, reemplazamos
        if ($file = $request->file('image')) {
            // eliminar la vieja
            if ($product->image_url && file_exists(public_path($product->image_url))) {
                unlink(public_path($product->image_url));
            }
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('img'), $filename);
            $data['image_url'] = 'img/' . $filename;
        }

        $product->update($data);

        return back()->with('ok', 'Producto actualizado correctamente');
    }

    // Elimina un producto
    public function destroy(Product $product)
    {
        // opcional: eliminar imagen asociada
        if ($product->image_url && file_exists(public_path($product->image_url))) {
            unlink(public_path($product->image_url));
        }

        $product->delete();

        return back()->with('ok', 'Producto eliminado');
    }
}
