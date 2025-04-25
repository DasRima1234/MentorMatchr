<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        $courses = Course::where('student_id', $id)
        ->orderBy('created_at')
        ->get();
        return view('students.show', compact('student','courses'));
    }
    
    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'pincode' => 'required|string|max:10',
            'phone' => 'required|string|max:15',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:15',
            'dob' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'education_level' => 'required|string|max:255',
            'school_name' => 'required|string|max:255',
        ]);

        Student::create($validatedData);

        return redirect()->route('students.index')->with('success', 'Student registered successfully.');
    }


    public function edit($id)
    {
        // Fetch the student record by ID
        $student = Student::findOrFail($id);

        // Decode the stored subjects if they're saved as JSON or comma-separated
        $selectedSubjects = json_decode($student->subjects); // Assuming it's a JSON array

        // Decode the achievements file paths (assuming it's stored as JSON or serialized array)
        $achievements = json_decode($student->achievements); // Assuming it's stored as a JSON array

        return view('students.edit', compact('student', 'selectedSubjects', 'achievements'));
    }



    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,'. $id,
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'pincode' => 'required|string|max:10',
            'phone' => 'required|string|max:15',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:15',
            'dob' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'education_level' => 'required|string|max:255',
            'school_name' => 'required|string|max:255',
        ]);

        $student->update($validatedData);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
