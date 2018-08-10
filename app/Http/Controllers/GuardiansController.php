<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guardian;

class GuardiansController extends Controller
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
        $guardians = Guardian::where('active', 1)->get();
        return view('guardians.index')->with('guardians', $guardians);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('guardians.create');
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
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required',
            'address' => 'required'
        ]);

        $guardians = new Guardian();
        $guardians->first_name = $request->input('first_name');
        $guardians->last_name = $request->input('last_name');
        $guardians->contact_number = $request->input('contact_number');
        $guardians->address = $request->input('address');
        $guardians->active = 1;
        $guardians->save();
        if($request->input('ref') == 'students') {
            return redirect(route('students.create'));
        }
        return redirect(route('guardians.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guardian = Guardian::find($id);
        return $guardian;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guardians = Guardian::find($id);
        return view('guardians.edit')->with('guardians', $guardians);
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
            'first_name' =>'required',
            'last_name' =>'required',
            'contact_number' =>'required',
            'address' =>'required',
        ]);

        $guardian = Guardian::find($id);
        $guardian->first_name = $request->input('first_name');
        $guardian->last_name = $request->input('last_name');
        $guardian->contact_number = $request->input('contact_number');
        $guardian->address = $request->input('address');
        $guardian->save();

        return redirect('/guardians');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guardian = Guardian::find($id);
        $guardian->active = 0;
        $guardian->save();

        return redirect('/guardians');
    }
}
