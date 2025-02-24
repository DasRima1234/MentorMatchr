<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('reports.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        $grades = Grade::where('student_id', $id)->with('exam')->get();
        $attendance = Attendance::where('student_id', $id)->get();

        return view('reports.show', compact('student', 'grades', 'attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function generatePDF($id)
    {
        // Reuse the same logic as `show()`
        $student = Student::findOrFail($id);
        $grades = Grade::where('student_id', $id)->with('exam')->get();
        $attendance = Attendance::where('student_id', $id)->get();
        // dd($student,$grades,$attendance);
        $pdf = Pdf::loadView('reports.pdf', compact('student', 'grades', 'attendance'));
        return $pdf->download($student->first_name . '_report.pdf');
    }
}
