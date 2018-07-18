<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enrolled;
use App\EnrolledLog;
use App\Tutorial;

class EnrolledController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('enrolled.index')->with('students', $students);
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
            'student_id' => 'required',
            'tutorial_id' => 'required',
        ]);

        $enrolled = new Enrolled();
        $enrolled->student_id = $request->input('student_id');
        $enrolled->tutorial_id = $request->input('tutorial_id');

        $tutorial = Tutorial::find($request->input('tutorial_id'));

        
        if($tutorial->type == 'interest') {
            $enrolled->sessions_left = 15;
        }

        $enrolled->sessions_left = $request->input('sessions_left');
        $enrolled->credit = $tutorial->price;
        $enrolled->active = 1;

        $enrolled->save();

        $this->save_enrolled_log($enrolled);

        return redirect("/tutorials/{$tutorial->id}/enroll");
    }

    private function save_enrolled_log(Enrolled $enrolled) {
        $enrolled_logs = new EnrolledLog();
        $enrolled_logs->enrolled_id = $enrolled->id;
        $enrolled_logs->amount = $enrolled->credit;
        $enrolled_logs->transaction_type = 'credit';
        $enrolled_logs->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $enrolled = Enrolled::find($id);
        var_dump($enrolled);
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
        
    }
}
