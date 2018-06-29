<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\ProductLog;
use App\Buyer;
use App\BuyersTransactionLog;
use App\BuyersPurchasedProduct;

class ProductsExtraController extends Controller
{
    /**
     * Show all the products available for buying.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $this->validate($request,[
            'quantity' =>'required',
        ]);

        $product = Product::find($id);
        $product_log = new ProductLog();

        $quantity = $request->input('quantity');

        if($request->input('type') == 'buy' ||
            $request->input('type') == 'debt') {
            $product->quantity = $product->quantity - $quantity;
            $product_log->sold_to = $request->input('sold_to') == 0 ? null : $request->input('sold_to');
            $this->save_transaction_log($product_log, $product, $request);
        } else if($request->input('type') == 'add_stock') {
            $product->quantity = $product->quantity + $quantity;
            $product_log->sold_to = null;
        }


        $product->total_sold = $product->quantity;
        $product->save();

        $this->save_product_log($id, $product_log, $request, $product);
       
        if($product_log->sold_to != null){
            $this->save_buyers_purchased_product($request, $product, $product_log); 
        }
        return redirect('/products');
    }

    private function save_buyers_purchased_product(Request $request, 
        Product $product, ProductLog $product_log) {
        $buyers_purchased_product = new BuyersPurchasedProduct();
        $buyers_purchased_product->buyer_id = $request->input('sold_to');
        $buyers_purchased_product->product_id = $product->id;
        $buyers_purchased_product->product_log_id = $product_log->id;
        $buyers_purchased_product->value = $request->input('quantity') * $product->price;
        $buyers_purchased_product->paid = $request->input('type') == 'debt' ? 0 : 1;

        $buyers_purchased_product->save();
    }

    private function save_product_log($id, ProductLog $product_log, 
        Request $request, Product $product) {
        $product_log->product_id = $id;
        $product_log->type = $request->input('type');
        $product_log->total_sold = $request->input('quantity') * $product->price;
        $product_log->quantity = $request->input('quantity');
        $product_log->sold_by = Auth::id();

        $product_log->save();
    }

    private function save_transaction_log(ProductLog $product_log, 
        Product $product, Request $request) {
        $transaction_log = new BuyersTransactionLog();

        $transaction_log->buyer_id = $product_log->sold_to;
        $transaction_log->product_id = $product->id;
        $transaction_log->transaction_type = $request->input('type');
        $transaction_log->value = $request->input('quantity') * $product->price;
        
        $transaction_log->save();    
    }

    public function pay_debt($id) {
        $bpp = BuyersPurchasedProduct::find($id);
        $bpp->paid = 1;
        $bpp->save();
        
        $this->save_pay_product_log($bpp->product_log_id);

        return redirect('/buyers/' . $bpp->buyer_id);
    }

    private function save_pay_product_log($product_log_id) {
        $old_product_log = ProductLog::find($product_log_id);
        $product_log = new ProductLog();

        $product_log->sold_to = $old_product_log->sold_to;
        $product_log->product_id = $old_product_log->product_id;
        $product_log->type = "pay";
        $product_log->total_sold = $old_product_log->total_sold;
        $product_log->quantity = $old_product_log->quantity;
        $product_log->sold_by = Auth::id();

        $product_log->save();
    }
}
