<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use Illuminate\Http\Request;

class TutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tutors = Tutor::latest()->paginate(10);

        return view('tutors.index', compact('tutors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tutors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate form input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tutors,email',
            'phone' => 'required|nullable|string|max:20',
            'gender' => 'required|nullable|in:Male,Female,Other',
            'dob' => 'required|nullable|date',
            'qualification' => 'required|nullable|string|max:255',
            'subject_specialization' => 'required|string',
            'experience' => 'required|integer|min:0',
            'bio' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:Active,Inactive,Pending',
            'hourly_rate' => 'required|nullable|numeric|min:0',
            'availability' => 'nullable|json',
            'address' => 'required|nullable|string',
            'city' => 'required|nullable|string|max:100',
            'state' => 'required|nullable|string|max:100',
            'country' => 'required|nullable|string|max:100',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $filePath = $request->file('profile_picture')->store('tutors', 'public');
            $validatedData['profile_picture'] = $filePath;
        }

        Tutor::create($validatedData);

        return redirect()->route('tutors.index')->with('success', 'Tutor added successfully!');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tutor = Tutor::findOrFail($id);
        return view('tutors.show', compact('tutor'));
    }

    /**
     * Show the form for editing the specified tutor.
     */
    public function edit($id)
    {
        $tutor = Tutor::findOrFail($id);
        return view('tutors.edit', compact('tutor'));
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
        $tutor = Tutor::findOrFail($id);

        // Validate input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tutors,email,'. $id,
            'phone' => 'required|nullable|string|max:20',
            'gender' => 'required|nullable|in:Male,Female,Other',
            'dob' => 'required|nullable|date',
            'qualification' => 'required|nullable|string|max:255',
            'subject_specialization' => 'required|string',
            'experience' => 'required|integer|min:0',
            // 'bio' => 'nullable|string',
            // 'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:Active,Inactive,Pending',
            'hourly_rate' => 'required|nullable|numeric|min:0',
            // 'availability' => 'required|nullable|json',
            'city' => 'required|nullable|string|max:100',
            'state' => 'required|nullable|string|max:100',
            'country' => 'required|nullable',
        ]);

        // dd(353534);
        // Handle profile picture update
        if ($request->hasFile('profile_picture')) {
            $filePath = $request->file('profile_picture')->store('tutors', 'public');
            $validatedData['profile_picture'] = $filePath;
        }

        $tutor->update($validatedData);

        return redirect()->route('tutors.index')->with('success', 'Tutor updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tutor = Tutor::findOrFail($id);
        $tutor->delete();

        return redirect()->route('tutors.index')->with('success', 'Tutor deleted successfully!');
    }
}
