<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Course;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments.
     */
    public function index()
    {
        $payments = Payment::latest()->paginate(10);
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for recording a payment.
     */
    public function create()
    {
        $students = Student::pluck('first_name', 'id');
        $courses = Course::pluck('course_name', 'id');
        return view('payments.create', compact('students', 'courses'));
    }

    /**
     * Store a new payment record.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string',
            'status' => 'required|in:Pending,Completed,Failed',
            'transaction_id' => 'nullable|string',
            'payment_date' => 'nullable|date',
        ]);

        Payment::create($request->all());

        return redirect()->route('payments.index')->with('success', 'Payment recorded successfully!');
    }

    /**
     * Show the form for editing a payment record.
     */
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $students = Student::pluck('first_name', 'id');
        $courses = Course::pluck('course_name', 'id');
        return view('payments.edit', compact('payment', 'students', 'courses'));
    }

    /**
     * Update a payment record.
     */
    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string',
            'status' => 'required|in:Pending,Completed,Failed',
            'transaction_id' => 'nullable|string',
            'payment_date' => 'nullable|date',
        ]);

        $payment->update($request->all());

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully!');
    }

    /**
     * Remove a payment record.
     */
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully!');
    }
}
