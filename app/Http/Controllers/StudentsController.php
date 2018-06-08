<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Guardian;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        foreach($students as $student) {
            $student->academic_count = 0;
            $student->interest_count = 0;
            foreach($student->tutorials as $lesson) {
                if($lesson->type == 'academic') {
                    $student->academic_count += 1;
                    continue;
                }
                $student->interest_count += 1;
            }
        }
        // return '<pre>' . json_encode($students, JSON_PRETTY_PRINT) . '</pre>';
        return view('students.index')->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $guardians = Guardian::all('id', 'first_name', 'last_name');

        $guardians = $guardians->map(function($item, $key) {
            return [
                'id' => $item['id'],
                'name' => $item['first_name'] . ' ' . $item['last_name']
            ];
        });
        
        $guardians = $guardians->pluck('name', 'id');

        return view('students.create')->with('guardians' , $guardians);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' =>'required',
            'last_name' =>'required',
            'date_of_birth' =>'required',
            'gender' =>'required',
        ]);

        $student = new Student();
        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->date_of_birth = $request->input('date_of_birth');
        $student->gender = $request->input('gender');
        $student->guardian_id = $request->input('guardian_id');

        $student->save();

        return redirect('/students');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        foreach($student->enrolled as $enrolled) {
            foreach($student->tutorials as $tutorial) {
                if($enrolled->tutorial_id == $tutorial->id) {
                    $tutorial->sessions_left = $enrolled->sessions_left;
                    $tutorial->credit = $enrolled->credit;
                }
            }
        }
        // return $student->tutorials;
        return view('students.view')->with('student', $student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        
        $guardians = Guardian::all('id', 'first_name', 'last_name');

        $guardians = $guardians->map(function($item, $key) {
            return [
                'id' => $item['id'],
                'name' => $item['first_name'] . ' ' . $item['last_name']
            ];
        });
        
        $guardians = $guardians->pluck('name', 'id');

        return view('students.edit')->with('data', ['student' => $student, 'guardians' => $guardians]);
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
        $this->validate($request,[
            'first_name' =>'required',
            'last_name' =>'required',
            'date_of_birth' =>'required',
            'gender' =>'required',
        ]);

        $student = Student::find($id);
        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->date_of_birth = $request->input('date_of_birth');
        $student->gender = $request->input('gender');
        $student->guardian_id = $request->input('guardian_id');

        $student->save();

        return redirect('/students');
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
