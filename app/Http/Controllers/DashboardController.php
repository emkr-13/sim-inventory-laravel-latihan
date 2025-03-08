<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total produk
        $productCount = Product::count();

        // Hitung total supplier
        $supplierCount = Supplier::count();

        return Inertia::render('Dashboard', [
            'productCount' => $productCount,
            'supplierCount' => $supplierCount,
        ]);
    }
}
