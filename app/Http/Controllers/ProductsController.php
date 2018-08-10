<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\ProductLog;
use App\Buyer;
use App\BuyersTransactionLog;
use App\ProductEditHistory;

class ProductsController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all()->where('active', 1); 
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

        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');
        $product->total_sold = 0;
        $product->active = 1;
        $product->save();

        $this->store_edit_history($product->id, $product);

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
        $product = Product::find($id);
        
        return view('products.edit')->with('products', $product);
        // return view('products.buy');
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
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        $product = Product::find($id);
        
        $product_log_id = $this->store_in_product_logs($id, 'edit');
        $this->store_edit_history($id, null, $request);

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');
        $product->save();

        return redirect('/products');
    }

    /**
     * Save the specified resource's log in storage.
     *
     * @param  int  $id
     * @param  string  $type
     * @return int id of the last inserted log
     */
    private function store_in_product_logs($id, $type) {
        $product_log = new ProductLog();

        $product_log->product_id = $id;
        $product_log->type = $type;
        $product_log->total_sold = null;
        $product_log->quantity = null;
        $product_log->sold_by = Auth::id();

        $product_log->save();
    }

    /**
     * Save the specified resource's edit history in storage.
     *
     * @param  int  $id
     * @param  App\Product  $p
     * @param  \Illuminate\Http\Request  $request
     * @return null
     */
    private function store_edit_history($id, Product $p = null, Request $request = null) 
    {
        $product_edit_history = new ProductEditHistory();

        $product_edit_history->product_name = $request ? $request->input('name') : $p->name; 
        $product_edit_history->description = $request ? $request->input('description') : $p->description; 
        $product_edit_history->quantity = $request ? $request->input('quantity') : $p->quantity; 
        $product_edit_history->price = $request ? $request->input('price') : $p->price; 
        $product_edit_history->product_id = $id;
        $product_edit_history->edited_by = Auth::id();

        $product_edit_history->save();
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
        $product->active = 0;
        $product->save();

        $this->store_in_product_logs($id, 'delete');
        return redirect('/products');
    }
}
