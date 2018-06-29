<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buyer;
use App\Product;
use App\ProductLog;
use App\BuyersPurchasedProduct;

class BuyersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('buyers.index')->with('buyers', Buyer::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buyers.create');
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
        ]);

        $buyer = new Buyer();
        $buyer->name = $request->input('name');
        $buyer->address = $request->input('address');
        $buyer->contact_no = $request->input('contact_no');
        $buyer->save();

        return redirect('/buyers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buyer = Buyer::find($id);
        $buyer->products_bought = BuyersPurchasedProduct::where('buyer_id', $id)->where('paid', 1)->get();
        $buyer->unpaid_products = BuyersPurchasedProduct::where('buyer_id', $id)->where('paid', 0)->get();
        $buyer->transaction_log;
        
        foreach($buyer->unpaid_products as $unpaid){
            $orig_product = Product::find($unpaid->product_id);
            $unpaid->name = $orig_product->name;
            $unpaid->price = $orig_product->price;

            $unpaid->quantity = ProductLog::find($unpaid->product_log_id)->quantity;
        }
        
        foreach($buyer->products_bought as $product) {
            $orig_product = Product::find($product->product_id);
            $product->name = $orig_product->name;
            $product->price = $orig_product->price;
            
            $product->quantity = ProductLog::find($product->product_log_id)->quantity;
        }

        // return '<pre>' . json_encode($buyer, JSON_PRETTY_PRINT) . '</pre>';
        return view('buyers.view')->with('buyer', $buyer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buyers = Buyer::find($id);
        return view('buyers.edit')->with('buyers', $buyers);
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
            'name' =>'required',
            'address' =>'required',
            'contact_number' =>'required',
        ]);

        $buyers = Buyer::find($id);
        $buyers->name = $request->input('name');
        $buyers->contact_no = $request->input('contact_number');
        $buyers->address = $request->input('address');
        $buyers->save();

        return redirect('/buyers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buyer = Buyer::find($id);
        $buyer->delete();
        return redirect('/buyers');
    }
}
