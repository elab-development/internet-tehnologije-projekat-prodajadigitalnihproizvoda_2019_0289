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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type'=>'required|string|max:255',
            'price' => 'required|integer|between:10,300',
            'num_of_downloads' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $product = Product::create([
            'name' => $request->name,
            'type'=>$request->type,
            'price' => $request->price,
            'num_of_downloads' => $request->num_of_downloads,
        ]);

        return response()->json([
            'message' => 'Product was created',
            'product' => new ProductResource($product)
        ]);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|integer|between:10,300',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $product->name = $request->name;
        $product->price = $request->price;

        $product->save();

        return response()->json([
            'message' => 'Product was updated',
            'product' => new ProductResource($product)
        ]);
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