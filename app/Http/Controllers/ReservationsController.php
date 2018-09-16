<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Room;
use App\Reservation;

class ReservationsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $rooms = Room::roomsForSelectOption();
        return view('boarding_house.reservation', compact('rooms'));
    }

    public function store() {
        $room = Room::find(request()->room);

        $this->validate(request(), [
            'date_start' => 'required',
            'date_end' => 'required', 
            'first_name' => 'required', 
            'last_name' => 'required', 
            'contact_no' => 'required|numeric', 
            'pax' => 'required|numeric', 
        ]);

        $room->reserve(request([
            'date_start',
            'date_end',
            'first_name',
            'last_name',
            'contact_no',
            'pax',
        ]));

        return redirect(route('boarding_house.show', $room->id));
    }

    public function events() {
        $events = Reservation::events();
        return response($events, 200);
    }
}
