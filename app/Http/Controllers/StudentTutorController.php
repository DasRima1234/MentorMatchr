<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Tutor;

class StudentTutorController extends Controller
{
    /**
     * Display a list of assigned tutors with students.
     */
    public function index()
    {
        $students = Student::all();
        $tutors = Tutor::all();
        $assignments = Tutor::with('students')->get(); // Get all tutor-student assignments

        return view('student-tutor.index', compact('students', 'tutors', 'assignments'));
    }

    /**
     * Show the form for assigning a student to a tutor.
     */
    public function create()
    {
        $students = Student::all();
        $tutors = Tutor::all();
        return view('admin.assign-student-tutor', compact('students', 'tutors'));
    }

    /**
     * Store a newly created student-tutor assignment.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'tutor_id' => 'required|exists:tutors,id',
        ]);

        $student = Student::find($request->student_id);
        $tutor = Tutor::find($request->tutor_id);

        // Assign Student to Tutor
        $tutor->students()->syncWithoutDetaching([$student->id]);

        return redirect()->back()->with('success', 'Student assigned to Tutor successfully.');
    }

    /**
     * Show students with their assigned tutors.
     */
    public function show($id)
    {
        $student = Student::with('tutors')->findOrFail($id);
        return view('admin.student-tutor', compact('student'));
    }

    /**
     * Remove a student from a tutor.
     */
    public function destroy($id)
    {
        $assignment = explode('-', $id);
        $student_id = $assignment[0];
        $tutor_id = $assignment[1];

        $tutor = Tutor::find($tutor_id);
        $tutor->students()->detach($student_id);

        return redirect()->route('student-tutors.index')->with('success', 'Student removed from Tutor.');
    }
}
