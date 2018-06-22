<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tutorial;
use App\Student;

class TutorialsExtraController extends Controller
{
    public function enroll($id) {
        $tutorial = Tutorial::find($id);
        $students = Student::all();

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
}