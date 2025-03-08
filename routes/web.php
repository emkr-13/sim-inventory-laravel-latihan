<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
      // Produk
      Route::resource('products', ProductController::class);
      Route::resource('suppliers', SupplierController::class);

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
       // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

       // Produk
    Route::resource('products', ProductController::class);

       // Supplier
    Route::resource('suppliers', SupplierController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
     // Halaman Utama Produk
     Route::get('/products', [ProductController::class, 'index'])->name('products.index');

     // Halaman Tambah Produk
     Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
     Route::post('/products', [ProductController::class, 'store'])->name('products.store');

     // Halaman Edit Produk
     Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
     Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

     // Hapus Produk (Soft Delete)
     Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

     // Halaman Produk yang Dihapus (Trash)
     Route::get('/products/trashed', [ProductController::class, 'trashed'])->name('products.trashed');

     // Restore Produk
     Route::post('/products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');

     // Permanent Delete Produk
     Route::delete('/products/{id}/force-delete', [ProductController::class, 'forceDelete'])->name('products.force-delete');

     // Halaman Utama Supplier
     Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');

     // Halaman Tambah Supplier
     Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
     Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');

     // Halaman Edit Supplier
     Route::get('/suppliers/{supplier}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
     Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');

     // Hapus Supplier (Soft Delete)
     Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

     // Halaman Supplier yang Dihapus (Trash)
     Route::get('/suppliers/trashed', [SupplierController::class, 'trashed'])->name('suppliers.trashed');

     // Restore Supplier
     Route::post('/suppliers/{id}/restore', [SupplierController::class, 'restore'])->name('suppliers.restore');

     // Permanent Delete Supplier
     Route::delete('/suppliers/{id}/force-delete', [SupplierController::class, 'forceDelete'])->name('suppliers.force-delete');
});

require __DIR__.'/auth.php';
