<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'sku'=>'required|string|max:100|unique:products,sku',
            'category'=>'required|string|max:255',
            'price'=>'required|numeric|min:0',
            'stock'=>'required|integer|min:0',
        ], [
            'name.required'=>'Ürün adı zorunludur.',
            'name.max'=>'Ürün adı en fazla 255 karakter olabilir.',
            'sku.required'=>'Stok kodu (SKU) zorunludur.',
            'sku.unique'=>'Bu stok kodu (SKU) zaten kullanılıyor.',
            'category.required'=>'Kategori seçimi zorunludur.',
            'price.required'=>'Fiyat alanı zorunludur.',
            'price.numeric'=>'Fiyat sayısal bir değer olmalıdır.',
            'price.min'=>'Fiyat 0 veya daha büyük olmalıdır.',
            'stock.required'=>'Stok adedi zorunludur.',
            'stock.integer'=>'Stok adedi tam sayı olmalıdır.',
            'stock.min'=>'Stok adedi 0 veya daha büyük olmalıdır.',
        ]);

        Product::create($request->only(['name', 'sku', 'category', 'price', 'stock']));

        return redirect()->route('products.index')->with('success', 'Ürün başarıyla eklendi.');
        
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Ürün başarıyla silindi.');

    }
}
