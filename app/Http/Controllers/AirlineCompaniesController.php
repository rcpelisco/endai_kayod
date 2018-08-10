<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AirlineCompany;

class AirlineCompaniesController extends Controller
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
        $airline_companies = AirlineCompany::all();
        return view('airline_companies.index')->with('airline_companies', $airline_companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('airline_companies.create');
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
            'address' => 'required',
            'phone_number' => 'required',
            'logo_path' => 'required',
        ]);

        $path = $request->file('logo_path')->store('images');
            
        $airline_company = new AirlineCompany();
        $airline_company->name = $request->input('name');
        $airline_company->address = $request->input('address');
        $airline_company->phone_number = $request->input('phone_number');
        $airline_company->email = $request->input('email');
        $airline_company->logo_path = $path;
        $airline_company->save();

        $request->file('logo_path')->move(public_path('images'), $path);

        return redirect('/airline_companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $airline_company = AirlineCompany::find($id);
        return view('airline_companies.view')->with('airline_company', $airline_company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $airline_company = AirlineCompany::find($id);
        return view('airline_companies.edit')->with('airline_company', $airline_company);
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
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
        ]);

        
        $airline_company = AirlineCompany::find($id);
        $airline_company->name = $request->input('name');
        $airline_company->address = $request->input('address');
        $airline_company->phone_number = $request->input('phone_number');
        $airline_company->email = $request->input('email');

        if($request->hasFile('logo_path')) {
            $path = $request->file('logo_path')->store('images');
            $airline_company->logo_path = $path;
            $request->file('logo_path')->move(public_path('images'), $path);
        }

        $airline_company->save();

        return redirect('/airline_companies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $airline_company = AirlineCompany::find($id);
        $airline_company->delete();
        return redirect('/airline_companies');
    }
}
