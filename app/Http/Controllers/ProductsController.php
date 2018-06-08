<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\ProductLog;
use App\Buyer;
use App\BuyersTransactionLog;

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
        $buyers = Buyer::all()->pluck('name', 'id');
        $buyers[0] = '(Not registered)';
        
        $items = $buyers->all();
        ksort($items);
        $buyers = collect($items);

        $data = (object) [
            'product' => $product,
            'buyers' => $buyers,
        ];

        return view('products.buy')->with('data', $data);
    }

    public function add_stock($id) {
        $product = Product::find($id);
        return view('products.add_stock')->with('product', $product);
    }

    public function updateQuantity(Request $request, $id) {
        $this->validate($request,[
            'quantity' =>'required',
        ]);

        $product = Product::find($id);
        $product_log = new ProductLog();
        

        $quantity = $request->input('quantity');

        if($request->input('type') == 'buy'){
            $product->quantity = $product->quantity - $quantity;
            $product_log->sold_to = $request->input('sold_to');
            $this->save_transation_log($id, $product_log, $product, $request);
        }else{
            $product->quantity = $product->quantity + $quantity;
            $product_log->sold_to = null;
            
        }
        $product->total_sold = $product->quantity;
        $product->save();

        $product_log->product_id = $id;
        $product_log->type = $request->input('type');
        $product_log->total_sold = $request->input('quantity') * $product->price;
        $product_log->quantity = $request->input('quantity');
        $product_log->sold_by = Auth::id();

        $product_log->save();

        return redirect('/products');
    }

    private function save_transation_log($id, $product_log, $product, $request) {
        $transaction_log = new BuyersTransactionLog();

        $transaction_log->buyer_id = $product_log->sold_to;
        $transaction_log->product_id = $id;
        $transaction_log->transaction_type = 'buy';
        $transaction_log->value = $request->input('quantity') * $product->price;
        
        $transaction_log->save();    
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
        $product = Product::find($id);
        $product->delete();
        return redirect('/products');
    }
}
