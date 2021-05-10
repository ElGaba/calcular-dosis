<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SpeciesController;
use App\Models\Product;
use App\Models\Species;
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
    return view('products', [
            'products' => Product::all(),
            'species' => Species::all(),
        ]);
})->name('products');

Route::get('/products/create', function () {
    return view('products-create', ['species' => Species::all()]);
})->name('products.create')->middleware('auth');

Route::get('/products/species/{specie}/product/{product}', function (Species $specie, Product $product) {
    return view('products', [
        'products' => $specie->products,
        'species' => Species::all(),
        'selectedSpecie' => $specie,
        'selectedProduct' => $product
        ]);
});

Route::get('/products/species/{specie}', function (Species $specie) {
    return view('products', [
        'products' => $specie->products,
        'species' => Species::all(),
        'selectedSpecie' => $specie
        ]);
});

Route::post('/products/species/{specie}/product/{product}/calculate', [ProductsController::class, 'calculate'])->name('products.calculate');

Route::post('/products', [ProductsController::class, 'store'])->middleware('auth');

Route::get('/species', function () {
    return view('species', ['species' => Species::all()]);
})->name('species')->middleware('auth');

Route::post('/species', [SpeciesController::class, 'store'])->middleware('auth');



require __DIR__.'/auth.php';
