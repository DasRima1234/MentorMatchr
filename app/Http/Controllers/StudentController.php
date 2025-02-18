<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        try {
            $request->validate([
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
                'address' => 'required|string|max:1000',
                'education_level' => 'required|string|max:255',
                'subjects' => 'required|array',
                'subjects.*' => 'string|max:255',
                'school_name' => 'required|string|max:255',
                'achievements' => 'nullable',
                'resources' => 'required|array|max:5',
                'resources.*' => 'string|max:255',
                'skills' => 'required|array|max:5',
                'skills.*' => 'string|max:255',
                'interests' => 'required|string|max:1000',
            ]);
            // dd($request->all());
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }

        $achievementFiles = [];
        if ($request->hasFile('achievements')) {
            foreach ($request->file('achievements') as $file) {
                $path = $file->store('achievements', 'public');
                $achievementFiles[] = $path;
            }
        }
        // dd($request->all());

        // Create the student
        $student = Student::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'pincode' => $request->pincode,
            'phone' => $request->phone,
            'guardian_name' => $request->guardian_name,
            'guardian_phone' => $request->guardian_phone,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'address' => $request->address,
            'education_level' => $request->education_level,
            'subjects' => json_encode($request->subjects), // Store as JSON
            'school_name' => $request->school_name,
            'achievements' => json_encode($achievementFiles), // Store file paths as JSON
            'resources' => json_encode($request->resources), // Store as JSON
            'skills' => json_encode($request->skills), // Store as JSON
            'interests' => $request->interests,
        ]);

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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
