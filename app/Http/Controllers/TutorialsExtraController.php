<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tutorial;
use App\Student;
use App\Enrolled;

class TutorialsExtraController extends Controller
{
    public function enroll($id) {
        $tutorial = Tutorial::find($id);
        $students = Student::where('active', 1)->get();
        $tutorial->enrolled;
        
        foreach($students as $student) {
            $student->enrolled = false;
            foreach($tutorial->students as $enrolled) {
                if($enrolled->id == $student->id) {
                    $student->enrolled = true;
                }
            }
            foreach($tutorial->enrolled as $enrolled) {
                if($enrolled->student_id == $student->id) {
                    $student->enrolled = $enrolled->active == 1 ? true : false;
                }
            }
        }

        $data = (object) ['tutorial' => $tutorial, 'students' => $students];
        // return '<pre>' . json_encode($data, 128) . '</pre>';
        return view('tutorials.enroll')->with('data', $data);
    }
    
    public function drop(Request $request) {
        $tutorial_id = $request->input('tutorial_id');
        $student_id = $request->input('student_id');

        $link = Enrolled::where('tutorial_id', $tutorial_id)
            ->where('student_id', $student_id)
            ->first();
        $link->active = 0;
        $link->save();
        
        return back();
    }
}