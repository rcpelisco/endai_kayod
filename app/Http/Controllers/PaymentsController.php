<?php

namespace App\Http\Controllers;

use App\Boarder;

class PaymentsController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }
    
    public function store(Boarder $boarder) {
        $boarder->pay(request(['amount']));
        return redirect(route('boarders.show', $boarder->id));
    }
}
