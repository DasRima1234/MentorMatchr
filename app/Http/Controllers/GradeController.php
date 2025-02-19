<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Exam;
use App\Models\Student;

class GradeController extends Controller
{
    /**
     * Display a listing of grades.
     */
    public function index()
    {
        $grades = Grade::latest()->paginate(10);
        return view('grades.index', compact('grades'));
    }

    /**
     * Show the form for creating a new grade.
     */
    public function create()
    {
        $exams = Exam::pluck('exam_name', 'id');
        $students = Student::pluck('first_name', 'id');
        return view('grades.create', compact('exams', 'students'));
    }

    /**
     * Store a new grade record.
     */
    public function store(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'student_id' => 'required|exists:students,id',
            'score' => 'required|numeric|min:0|max:100',
            'grade' => 'required|string|max:2',
        ]);

        Grade::create($request->all());

        return redirect()->route('grades.index')->with('success', 'Grade added successfully!');
    }

    /**
     * Show the form for editing a grade.
     */
    public function edit($id)
    {
        $grade = Grade::findOrFail($id);
        $exams = Exam::pluck('exam_name', 'id');
        $students = Student::pluck('first_name', 'id');
        return view('grades.edit', compact('grade', 'exams', 'students'));
    }

    /**
     * Update a grade record.
     */
    public function update(Request $request, $id)
    {
        $grade = Grade::findOrFail($id);

        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'student_id' => 'required|exists:students,id',
            'score' => 'required|numeric|min:0|max:100',
            'grade' => 'required|string|max:2',
        ]);

        $grade->update($request->all());

        return redirect()->route('grades.index')->with('success', 'Grade updated successfully!');
    }

    /**
     * Remove a grade record.
     */
    public function destroy($id)
    {
        $grade = Grade::findOrFail($id);
        $grade->delete();

        return redirect()->route('grades.index')->with('success', 'Grade deleted successfully!');
    }
}
