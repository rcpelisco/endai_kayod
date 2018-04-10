<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AirlineCompany;

class AirlineCompaniesController extends Controller
{
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
            'email' => 'required',
            'logo_path' => 'required',
            'pnr' => 'required',
        ]);

        $airline_company = new AirlineCompany();
        $airline_company->name = $request->input('name');
        $airline_company->address = $request->input('address');
        $airline_company->phone_number = $request->input('phone_number');
        $airline_company->email = $request->input('email');
        $airline_company->pnr = $request->input('pnr');

        $airline_company->save();

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
        $airline_companies = AirlineCompanies::find($id);
        return view('airline_companies.view');
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
        return view('airline_companies.create')->with('airline_company', $airline_company);
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
            'email' => 'required',
            'logo_path' => 'required',
            'pnr' => 'required',
        ]);

        $airline_company = AirlineCompany::find();
        $airline_company->name = $request->input('name');
        $airline_company->address = $request->input('address');
        $airline_company->phone_number = $request->input('phone_number');
        $airline_company->email = $request->input('email');
        $airline_company->pnr = $request->input('pnr');

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
        //
    }
}
