<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $products = Product::when($q, fn($qr) => $qr->where('name','like',"%{$q}%"))
                           ->where('stock','>',0)
                           ->orderBy('name')
                           ->get();

        return view('cliente.home', compact('products','q'));
    }
}
