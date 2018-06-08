<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buyer;
use App\Product;
use App\ProductLog;

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
        $buyer->products_bought = collect();
        foreach($buyer->transaction_log as $entry) {
            $buyer->products_bought = $buyer->products_bought
                ->push(Product::select('id', 'name', 'price')
                ->find($entry->product_id))->unique();
        }
        foreach($buyer->products_bought as $product) {

            $total_bought = ProductLog::select('quantity')->where([
                ['product_id', $product->id],
                ['sold_to', $buyer->id],
            ])->get();
            
            $quantity = 0;

            foreach($total_bought as $item) {
                $quantity += $item->quantity;
            }

            $product->total_bought = $quantity;
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
        //
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
        $buyer = Buyer::find($id);
        $buyer->delete();
        return redirect('/buyers');
    }
}
