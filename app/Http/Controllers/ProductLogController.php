<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductLog;

class ProductLogController extends Controller
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
        $product_logs = ProductLog::orderBy('id', 'desc')->get()->sortByDesc('id');
        foreach($product_logs as $product_log) {
            $product_log->buyer = $product_log->buyer ? $product_log->buyer : (object) ['name' => 'n/a'];
            $product_log->formatted_created_at = date('F d, Y H:i A', strtotime($product_log->created_at));
        }
        return view('product_log.index')->with('product_logs', $product_logs);
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
        $this->validate($request, [
            'product_id' => 'required',
            'total_sold' => 'required',
            'type' => 'type',
            'quantity' => 'required',
        ]);
        
        $product_log = new ProductLog();
        $product_log->total_sold = $request->input('total_sold');
        $product_log->quantity = $request->input('quantity');
        $product_log->product_id = $request->input('product_id');
        $product_log->type = $request->input('type');
        $product_log->sold_to = $request->input('sold_to');
        $product_log->sold_by = Auth::id();
        
        $product_log->save();
        return redirect('/product_log');
    }
}
