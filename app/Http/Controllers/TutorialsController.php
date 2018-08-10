<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tutorial;
use App\Student;

class TutorialsController extends Controller
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
        $tutorials = Tutorial::where('active', 1)->get();
        
        // return '<pre>' . json_encode($tutorials, JSON_PRETTY_PRINT) . '</pre>';
        return view('tutorials.index')->with('tutorials', $tutorials);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tutorials.create');
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
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'type' => 'required',
        ]);

        $tutorial = new Tutorial();
        $tutorial->title = $request->input('title');
        $tutorial->description = $request->input('description');
        $tutorial->price = $request->input('price');
        $tutorial->type = $request->input('type');
        if($tutorial->type == 'interest'){
            $tutorial->sessions = $request->input('sessions');
        }

        $tutorial->active = 1;

        $tutorial->save();

        return redirect('/tutorials');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tutorial = Tutorial::find($id);
        // return '<pre>' . json_encode($tutorial->students->first()->enrolled, 128) . '</pre>';
        return view('tutorials.view')->with('tutorial', $tutorial);
        // return var_dump($tutorial->enrolled);
    }

    public function view($id) {
        $tutorial = Tutorial::find($id);
        return view('tutorials.view')->with('tutorial', $tutorial);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tutorials = Tutorial::find($id);
        return view('tutorials.edit')->with('tutorials', $tutorials);
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
            'title' =>'required',
            'description' =>'required',
            'price' =>'required',
        ]);

        $tutorials = Tutorial::find($id);
        $tutorials->title = $request->input('title');
        $tutorials->description = $request->input('description');
        $tutorials->price = $request->input('price');
        $tutorials->save();

        return redirect('/tutorials');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tutorial = Tutorial::find($id);
        $tutorial->active = 0;
        $tutorial->save();

        return redirect('/tutorials');
    }
}
