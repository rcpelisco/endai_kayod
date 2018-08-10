<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Boarder;

class BoardersController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }
    
    public function index() {
        $boarders = Boarder::all();
        return view('boarders.index', compact('boarders'));
    }

    public function show(Boarder $boarder) {
        // return $boarder->totalPayment();
        return view('boarders.view', compact('boarder'));
    }

    public function getAgreementImg($fileName) {

    }

    public function create() {
        
    }

    public function store() {

    }

    public function destroy(Boarder $boarder) {
        if($boarder->balance() == 0) {
            $boarder->setInactive();
            return redirect(route('boarding_house.index'));
        }
        return back();
    }
}
