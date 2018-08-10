<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\FlightTicket;
use App\AirlineCompany;
use PDF;

class FlightTicketsController extends Controller
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
        $flight_tickets = FlightTicket::where('primary_ticket_id', null)->get();
        
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
        
        $random_str = $this->generate_random();
 
        $airline_companies = $airline_companies->pluck('name', 'id');
        
        $data = (object) ['random_str' => $random_str, 'airline_companies' => $airline_companies];

        return view('flight_tickets.create')->with('data', $data);
    }

    function generate_random($random_str = null) {
        $old_entry = FlightTicket::where('booking_reference', $random_str)->first();
        if($old_entry == null && $random_str != null) {
            return $random_str;
        }
        $random = $this->random_str(6);
        $this->generate_random($random);
        return $random;
    }

    function random_str($length, $keyspace = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ') {
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
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

        $this->save_second_ticket($flight_ticket, $request);

        return redirect('/flight_tickets');
    }

    private function save_second_ticket(FlightTicket $flight_ticket, Request $request) {
        if($request->input('flight_type') != 'round_trip')
            return;
        $flight_ticket_2 = new FlightTicket();
        $flight_ticket_2->issue_date = $flight_ticket->issue_date;
        $flight_ticket_2->booking_date = $flight_ticket->booking_date;
        $flight_ticket_2->booking_reference = $flight_ticket->booking_reference;
        $flight_ticket_2->flight_number = $flight_ticket->flight_number = strtoupper($request->input('flight_number_2'));
        $flight_ticket_2->origin = $flight_ticket->origin = strtoupper($request->input('origin_2'));
        $flight_ticket_2->destination = $flight_ticket->destination = strtoupper($request->input('destination_2'));
        $flight_ticket_2->departure_date = $flight_ticket->departure_date = date('Y-n-d G:i:s', 
            strtotime($request->input('departure_date_2')));
        $flight_ticket_2->arrival_date = $flight_ticket->arrival_date = date('Y-n-d G:i:s', 
            strtotime($request->input('arrival_date_2')));
        $flight_ticket_2->passenger_name = $flight_ticket->passenger_name;
        $flight_ticket_2->ticket_number = $flight_ticket->ticket_number;
        $flight_ticket_2->pax_type = $flight_ticket->pax_type = $request->input('pax_type');
        $flight_ticket_2->add_on_baggage = $flight_ticket->add_on_baggage = $request->input('add_on_baggage_2');
        $flight_ticket_2->total_amount = $flight_ticket->total_amount = $request->input('total_amount');
        $flight_ticket_2->airline_company_id = $flight_ticket->airline_company_id = $request->input('airline_company_id');
        $flight_ticket_2->pnr = $flight_ticket->pnr = strtoupper($request->input('pnr'));
        $flight_ticket_2->primary_ticket_id = $flight_ticket->id;
        $flight_ticket_2->save();
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
        $flight_ticket->second_flight = FlightTicket::where('primary_ticket_id', $id)->get()->first();

        $pdf = PDF::loadView('flight_tickets.view', ['flight_ticket' => $flight_ticket]);
        // return '<pre>' . json_encode($flight_ticket, JSON_PRETTY_PRINT) . '</pre>';
        return $pdf->stream('flight_ticket.pdf');
        // return view('flight_tickets.view')->with('flight_ticket', $flight_ticket);
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

        $airline_companies = AirlineCompany::all();
        $airline_companies = $airline_companies->pluck('name', 'id');

        $flight_ticket->departure_date = date('n/d/Y G:i A', 
            strtotime($flight_ticket->departure_date));
        $flight_ticket->arrival_date = date('n/d/Y G:i A', 
            strtotime($flight_ticket->arrival_date));

        return view('flight_tickets.edit')->with('data', [
            'flight_ticket' => $flight_ticket, 
            'airline_companies' => $airline_companies
        ]);
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
        $flight_ticket = FlightTicket::find($id);
        $flight_ticket->delete();
        return redirect('/flight_tickets');
    }
}
