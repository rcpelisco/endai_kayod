<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\ProductLog;
use App\Buyer;
use App\BuyersTransactionLog;

class ProductsExtraController extends Controller
{
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

    public function update_quantity(Request $request, $id) {
        return $id;
        // $this->validate($request,[
        //     'quantity' =>'required',
        // ]);

        // $product = Product::find($id);
        // $product_log = new ProductLog();

        // $quantity = $request->input('quantity');

        // if($request->input('type') == 'buy'){
        //     $product->quantity = $product->quantity - $quantity;
        //     $product_log->sold_to = $request->input('sold_to');
        //     $this->save_transaction_log($id, $product_log, $product, $request);
        // }else{
        //     $product->quantity = $product->quantity + $quantity;
        //     $product_log->sold_to = null;
            
        // }
        // $product->total_sold = $product->quantity;
        // $product->save();

        // $this->save_product_log($id, $product_log, $request, $product);
       
        // return redirect('/products');
    }

    // private function save_buyers_purchased_product(Request $request) {
    //     $buyers_purchased_product = new BuyersPurchasedProduct();
    //     $buyers_purchased_product->value
    // }

    private function save_product_log($id, ProductLog $product_log, 
        Request $request, Product $product) {
        $product_log->product_id = $id;
        $product_log->type = $request->input('type');
        $product_log->total_sold = $request->input('quantity') * $product->price;
        $product_log->quantity = $request->input('quantity');
        $product_log->sold_by = Auth::id();

        $product_log->save();
    }

    private function save_transaction_log($id, ProductLog $product_log, 
        Product $product, Request $request) {
        $transaction_log = new BuyersTransactionLog();

        $transaction_log->buyer_id = $product_log->sold_to;
        $transaction_log->product_id = $id;
        $transaction_log->transaction_type = 'buy';
        $transaction_log->value = $request->input('quantity') * $product->price;
        
        $transaction_log->save();    
    }
}
