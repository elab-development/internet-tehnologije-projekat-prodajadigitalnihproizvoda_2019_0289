<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProductCollection;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return new ProductCollection($products);

    }

    public function indexType($type)
{
    $products = Product::get()->where('type', $type); 
    return response()->json($products);
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
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'type' => 'required|string|max:255',
            'num_of_downloads' => 'required|integer|min:0',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->type = $request->type;
        $product->num_of_downloads = $request->num_of_downloads;
        $product->save();

        return response()->json(['message' => 'Proizvod je uspješno spremljen'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product_id)
    {
        $product = Product::find($product_id);
        if (is_null($product)) {
            return response()->json('Product not found', 404);
        }
        return new ProductResource($product);
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
    $validatedData = $request->validate([
        'name' => 'required|string',
        'price' => 'required|numeric',
        'type' => 'required|string'
    ]);

    $product->update($validatedData);

    return response()->json($product);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json('Product was deleted');
    }
}