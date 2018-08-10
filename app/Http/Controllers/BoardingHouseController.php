<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Room;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CreateBoarderFromRoomForm;
use App\Http\Requests\BoardingHouseForm;

class BoardingHouseController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }
    
    public function index() {
        $rooms = Room::all();
        return view('boarding_house.index', compact('rooms'));
    }

    public function show(Room $room) {
        return view('boarding_house.view', compact('room'));
    }

    public function create() {
        return view('boarding_house.create');
    }
    
    public function store(BoardingHouseForm $request) {
        $request->persist();

        return redirect(route('boarding_house.index'));
    }

    public function createBoarder(Room $room, CreateBoarderFromRoomForm $request) {
        $file = null;
        $fileName = '';
        if($room->type == 'monthly') {
            $this->validate(request(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'contact_no' => 'required|numeric',
                'occupation' => 'required',
                'agreement' => 'required',
            ]);
            $file = request()->file('agreement');
        }
        
        $request->persist($room, $file);
        
        return redirect(route('boarding_house.index'));
    }

    public function edit(Room $room) {

    }

    public function destroy(Room $room) {

    }
}
