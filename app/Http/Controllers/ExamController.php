<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Course;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::latest()->paginate(10);
        return view('exams.index', compact('exams'));
    }

    public function create()
    {
        $courses = Course::pluck('course_name', 'id');
        return view('exams.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'exam_name' => 'required|string|max:255',
            'exam_date' => 'required|date',
        ]);

        Exam::create($request->all());

        return redirect()->route('exams.index')->with('success', 'Exam added successfully!');
    }

    public function edit($id)
    {
        $exam = Exam::findOrFail($id);
        $courses = Course::pluck('course_name', 'id');
        return view('exams.edit', compact('exam', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'exam_name' => 'required|string|max:255',
            'exam_date' => 'required|date',
        ]);

        $exam->update($request->all());

        return redirect()->route('exams.index')->with('success', 'Exam updated successfully!');
    }

    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();

        return redirect()->route('exams.index')->with('success', 'Exam deleted successfully!');
    }
}
