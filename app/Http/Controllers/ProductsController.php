<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\ProductLog;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        // return view('products.buy')->with('products', $products);
        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        $products = new Product();
        $products->name = $request->input('name');
        $products->description = $request->input('description');
        $products->quantity = $request->input('quantity');
        $products->price = $request->input('price');
        $products->total_sold = 0;
        $products->save();
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('products.buy');
    }

    public function buy($id) {
        $product = Product::find($id);
        return view('products.buy')->with('product', $product);
    }

    public function updateQuantity(Request $request, $id) {
        $this->validate($request,[
            'quantity' =>'required',
        ]);

        $product = Product::find($id);
        $quantity = $request->input('quantity');
        $product->quantity = $product->quantity - $quantity;
        $product->total_sold = $product->total_sold + $quantity;
        $product->save();

        $product_log = new ProductLog();
        $product_log->product_id = $id;
        $product_log->total_sold = $request->input('quantity') * $product->price;
        $product_log->quantity = $request->input('quantity');
        $product_log->sold_by = Auth::id();

        $product_log->save();

        return redirect('/products');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
