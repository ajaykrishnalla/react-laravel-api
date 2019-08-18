<?php

namespace App\Http\Controllers\API;

use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;

class ProductsController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return   new ProductCollection(Product::paginate(20));
        // return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $p = new Product;
        $p->name = $request->name;
        $p->detail = $request->description;
        $p->stock = $request->stock;
        $p->price = $request->price;
        $p->discount = $request->discount;
        $p->save();
        return response()->json(['data' => new ProductResource($p)], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return response()->json(['data' => new ProductResource($product)], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['data' => "Successfully deleted"], 200);
        
    }
}
