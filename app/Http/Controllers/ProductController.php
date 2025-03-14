<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('supplier')->get();
        $suppliers = Supplier::all();
        return Inertia::render('Products/Index', [
            'products' => $products,
            'suppliers' => $suppliers,
        ]);
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return Inertia::render('Products/Create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $$products = Product::findOrFail($product);
        $suppliers = Supplier::all();

        return Inertia::render('Products/Edit', [
            'products' => $products,
            'supplier' => $supplier, // Kirim data supplier ke frontend
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validatedData =$request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $product->update($validatedData );
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function trashed()
    {
        $products = Product::onlyTrashed()->get();
        return Inertia::render('Products/Trashed', compact('products'));
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->forceDelete();
        return redirect()->route('products.index')->with('success', 'Produk dihapus permanen.');
    }
}
