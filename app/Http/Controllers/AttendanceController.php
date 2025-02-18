<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\ClassSchedule;
use App\Models\Student;

class AttendanceController extends Controller
{
    /**
     * Display a listing of attendances.
     */
    public function index()
    {
        $attendances = Attendance::latest()->paginate(10);
        return view('attendances.index', compact('attendances'));
    }

    /**
     * Show the form for marking attendance.
     */
    public function create()
    {
        $schedules = ClassSchedule::pluck('course_id', 'id');
        $students = Student::pluck('first_name', 'id');
        return view('attendances.create', compact('schedules', 'students'));
    }

    /**
     * Store a newly created attendance.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_schedule_id' => 'required|exists:class_schedules,id',
            'student_id' => 'required|exists:students,id',
            'status' => 'required|in:Present,Absent,Late,Excused',
            'remarks' => 'nullable|string',
        ]);

        Attendance::create($request->all());

        return redirect()->route('attendances.index')->with('success', 'Attendance recorded successfully!');
    }

    /**
     * Show the form for editing an attendance record.
     */
    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        $schedules = ClassSchedule::pluck('course_id', 'id');
        $students = Student::pluck('first_name', 'id');
        return view('attendances.edit', compact('attendance', 'schedules', 'students'));
    }

    /**
     * Update an attendance record.
     */
    public function update(Request $request, $id)
    {
        $attendance = Attendance::findOrFail($id);

        $request->validate([
            'class_schedule_id' => 'required|exists:class_schedules,id',
            'student_id' => 'required|exists:students,id',
            'status' => 'required|in:Present,Absent,Late,Excused',
            'remarks' => 'nullable|string',
        ]);

        $attendance->update($request->all());

        return redirect()->route('attendances.index')->with('success', 'Attendance updated successfully!');
    }

    /**
     * Remove an attendance record.
     */
    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return redirect()->route('attendances.index')->with('success', 'Attendance deleted successfully!');
    }
}
