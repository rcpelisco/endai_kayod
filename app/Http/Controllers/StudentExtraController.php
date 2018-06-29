<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enrolled;

class StudentExtraController extends Controller
{
    /**
     * Set the tutorial as paid form the said resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pay_tutorial($id){
        $enrolled = Enrolled::find($id);
        $enrolled->active = 1;
        $enrolled->save();

        return redirect('/students/' . $enrolled->student_id);
    }
}