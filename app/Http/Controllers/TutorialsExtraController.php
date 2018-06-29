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

        foreach($students as $student) {
            $student->enrolled = false;
            foreach($tutorial->students as $enrolled) {
                if($enrolled->id == $student->id) {
                    $student->enrolled = true;
                }
            }
        }

        $data = (object) ['tutorial' => $tutorial, 'students' => $students];
        
        return view('tutorials.enroll')->with('data', $data);
    }
    
    public function drop(Request $request) {
        $tutorial_id = $request->input('tutorial_id');
        $student_id = $request->input('student_id');

        $link = Enrolled::where('tutorial_id', $tutorial_id)
            ->where('student_id', $student_id)
            ->first();
        $link->delete();

        return back();
    }
}