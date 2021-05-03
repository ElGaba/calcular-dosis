<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Product::create(request()->validate([
            'name' => 'required',
            'dosis' => 'required|numeric',
            'concentration' => 'required|numeric'
        ]));

        return redirect(route('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function calculate(Product $product)
    {
        $inputs = request()->validate([
            'cantidadAnimales' => 'numeric|required',
            'cantidadAlimento' => 'numeric|required',
            'peso' => 'numeric|required'
        ]);

        $principioActivo = ($product->dosis * $inputs['cantidadAnimales'] * $inputs['peso']) / 1000;

        $dosisCalculada = $principioActivo * (1 / $product->concentration);

        $consumoDeAlimento = $inputs['cantidadAlimento'] * $inputs['cantidadAnimales'];

        $cantidadPorTonelada = round((1000 * $dosisCalculada) / $consumoDeAlimento, 3);

        return view('products', [
        'products' => Product::all(),
        'selectedProduct' => $product,
        'dosisCalculada' => $dosisCalculada,
        'consumoDeAlimento' => $consumoDeAlimento,
        'cantidadPorTonelada' => $cantidadPorTonelada
        ]);
    }
}
