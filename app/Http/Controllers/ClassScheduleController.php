<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassSchedule;
use App\Models\Course;
use App\Models\Tutor;

class ClassScheduleController extends Controller
{
    /**
     * Display a listing of class schedules.
     */
    public function index()
    {
        $schedules = ClassSchedule::latest()->paginate(10);
        return view('class_schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new class schedule.
     */
    public function create()
    {
        $courses = Course::pluck('course_name', 'id');
        $tutors = Tutor::pluck('name', 'id');
        return view('class_schedules.create', compact('courses', 'tutors'));
    }

    /**
     * Store a newly created class schedule in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'tutor_id' => 'required|exists:tutors,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'recurrence' => 'nullable|string|in:Daily,Weekly,Monthly',
            'status' => 'required|in:Scheduled,Completed,Cancelled',
        ]);

        ClassSchedule::create($request->all());

        return redirect()->route('class_schedules.index')->with('success', 'Class schedule created successfully!');
    }

    /**
     * Show the form for editing the specified class schedule.
     */
    public function edit($id)
    {
        $schedule = ClassSchedule::findOrFail($id);
        $courses = Course::pluck('course_name', 'id');
        $tutors = Tutor::pluck('name', 'id');
        return view('class_schedules.edit', compact('schedule', 'courses', 'tutors'));
    }

    /**
     * Update the specified class schedule.
     */
    public function update(Request $request, $id)
    {
        $schedule = ClassSchedule::findOrFail($id);

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'tutor_id' => 'required|exists:tutors,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'recurrence' => 'nullable|string|in:Daily,Weekly,Monthly',
            'status' => 'required|in:Scheduled,Completed,Cancelled',
        ]);

        $schedule->update($request->all());

        return redirect()->route('class_schedules.index')->with('success', 'Class schedule updated successfully!');
    }

    /**
     * Remove the specified class schedule from the database.
     */
    public function destroy($id)
    {
        $schedule = ClassSchedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('class_schedules.index')->with('success', 'Class schedule deleted successfully!');
    }
}
