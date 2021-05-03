<?php

use App\Http\Controllers\ProductsController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/products', function () {
    return view('products', ['products' => Product::all()]);
})->name('products');

Route::get('/products/create', function () {
    return view('products-create');
})->name('products.create')->middleware('auth');

Route::get('/products/{product}', function (Product $product) {
    return view('products', [
        'products' => Product::all(),
        'selectedProduct' => $product
        ]);
});

Route::post('/products/{product}/calculate', [ProductsController::class, 'calculate'])->name('products.calculate');

Route::post('/products', [ProductsController::class, 'store']);

require __DIR__.'/auth.php';
