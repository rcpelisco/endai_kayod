<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\FlightTicket;
use App\AirlineCompany;
use PDF;

class FlightTicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flight_tickets = FlightTicket::all();
        return view('flight_tickets.index')->with('flight_tickets', $flight_tickets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $airline_companies = AirlineCompany::all();
        
        $airline_companies = $airline_companies->pluck('name', 'id');

        return view('flight_tickets.create')->with('airline_companies', $airline_companies);
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
            'issue_date' => 'required',
            'booking_date' => 'required',
            'booking_reference' => 'required',
            'flight_number' => 'required',
            'origin' => 'required',
            'destination' => 'required',
            'departure_date' => 'required',
            'arrival_date' => 'required',
            'passenger_name' => 'required',
            'ticket_number' => 'required',
            'pax_type' => 'required',
            'add_on_baggage' => 'required',
            'total_amount' => 'required',
            'airline_company_id' => 'required',
            'pnr' => 'required',
        ]);

        $flight_ticket = new FlightTicket();
        $flight_ticket->issue_date = $request->input('issue_date');
        $flight_ticket->booking_date = $request->input('booking_date');
        $flight_ticket->booking_reference = strtoupper($request->input('booking_reference'));
        $flight_ticket->flight_number = strtoupper($request->input('flight_number'));
        $flight_ticket->origin = strtoupper($request->input('origin'));
        $flight_ticket->destination = strtoupper($request->input('destination'));
        $flight_ticket->departure_date = date('Y-n-d G:i:s', 
            strtotime($request->input('departure_date')));
        $flight_ticket->arrival_date = date('Y-n-d G:i:s', 
            strtotime($request->input('arrival_date')));
        $flight_ticket->passenger_name = $request->input('passenger_name');
        $flight_ticket->ticket_number = $request->input('ticket_number');
        $flight_ticket->pax_type = $request->input('pax_type');
        $flight_ticket->add_on_baggage = $request->input('add_on_baggage');
        $flight_ticket->total_amount = $request->input('total_amount');
        $flight_ticket->airline_company_id = $request->input('airline_company_id');
        $flight_ticket->pnr = strtoupper($request->input('pnr'));
        $flight_ticket->save();

        return redirect('/flight_tickets');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $flight_ticket = FlightTicket::find($id);
        $pdf = PDF::loadView('flight_tickets.view', $flight_ticket);
        return $pdf->download('flight_ticket.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $flight_ticket = FlightTicket::find($id);

        $airline_companies = $airline_companies->pluck('name', 'id');

        return view('flight_tickets.create')->with('data', ['flight_ticket' => $flight_ticket
        , 'airline_companies' => $airline_companies]);
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
            'issue_date' => 'required',
            'booking_date' => 'required',
            'booking_reference' => 'required',
            'flight_number' => 'required',
            'origin' => 'required',
            'destination' => 'required',
            'departure_date' => 'required',
            'arrival_date' => 'required',
            'passenger_name' => 'required',
            'ticket_number' => 'required',
            'pax_type' => 'required',
            'add_on_baggage' => 'required',
            'total_amount' => 'required',
            'airline_company_id' => 'required',
        ]);

        $flight_ticket = FlightTicket::find($id);
        $flight_ticket->issue_date = $request->input('issue_date');
        $flight_ticket->booking_date = $request->input('booking_date');
        $flight_ticket->booking_reference = $request->input('booking_reference');
        $flight_ticket->flight_number = $request->input('flight_number');
        $flight_ticket->origin = $request->input('origin');
        $flight_ticket->destination = $request->input('destination');
        $flight_ticket->departure_date = $request->input('departure_date');
        $flight_ticket->arrival_date = $request->input('arrival_date');
        $flight_ticket->passenger_name = $request->input('passenger_name');
        $flight_ticket->ticket_number = $request->input('ticket_number');
        $flight_ticket->pax_type = $request->input('pax_type');
        $flight_ticket->add_on_baggage = $request->input('add_on_baggage');
        $flight_ticket->total_amount = $request->input('total_amount');
        $flight_ticket->airline_company_id = $request->input('airline_company_id');

        $flight_ticket->save();

        return redirect('/flight_tickets');
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
