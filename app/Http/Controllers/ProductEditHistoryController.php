<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ProductEditHistory;
use App\ProductLog;
use App\Product;


class ProductEditHistoryController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product_edit_history = ProductEditHistory::where('product_id', $id)->get();
        $product = Product::find($id);
        $product_edit_history->latest = $product;
        
        return view('product_log.edit_history')->with('edit_history', $product_edit_history);
    }
}
