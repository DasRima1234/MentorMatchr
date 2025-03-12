<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Tutor;
use App\Models\User;

class Dashboard_V2_Controller extends Controller
{
    public function index(Request $request)
    {
        // dd(4354546);
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in.');
        }

        $user = Auth::user();
        // dd($user);
        // Check the user's role
        $userRoles = Auth::user()->getRoleNames();
        // dd($userRoles);
        
        if ($userRoles->contains('Admin') || $userRoles->contains('Owner')) {
            return $this->adminDashboard();
        
        } elseif ($userRoles->contains('Student')) {
            return $this->studentDashboard();
        } elseif ($userRoles->contains('Tutor')) {
            return $this->tutorDashboard();
        } else {
            return $this->adminDashboard();
        }
    }

    // public function index(Request $request)
    // {
    //    if(Auth::check()){
    //     return view('admin.country_dashboard');
    //    } else {
    //         return redirect()->route('login');
    //     }
    // }
    /**
     * Admin Dashboard
     */
    private function adminDashboard()
    {
        $totalStudents = Student::count();
        $totalTutors = Tutor::count();
        $totalCourses = Course::count();
        $totalEnrollments = Enrollment::count();
        $totalPayments = Payment::sum('amount');
        $totalAttendances = Attendance::count();

        $monthlyEnrollments = Enrollment::whereYear('created_at', Carbon::now()->year)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month');

        $monthlyRevenue = Payment::whereYear('payment_date', Carbon::now()->year)
            ->selectRaw('MONTH(payment_date) as month, SUM(amount) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        return view('admin.country_dashboard', compact(
            'totalStudents', 'totalTutors', 'totalCourses', 'totalEnrollments', 
            'totalPayments', 'totalAttendances', 'monthlyEnrollments', 'monthlyRevenue'
        ));
    }

    /**
     * Student Dashboard
     */
    private function studentDashboard()
    {
        $student = Auth::user();
        $enrollments = Enrollment::where('student_id', $student->id)->count();
        $grades = $student->grades ?? [];
        $attendance = Attendance::where('student_id', $student->id)->count();

        return view('dashboard.student_dashboard', compact('student', 'enrollments', 'grades', 'attendance'));
    }

    /**
     * Tutor Dashboard
     */
    private function tutorDashboard()
    {
        $tutor = Auth::user();
        $assignedCourses = Course::where('tutor_id', $tutor->id)->count();
        $studentsTaught = Enrollment::whereHas('course', function ($query) use ($tutor) {
            $query->where('tutor_id', $tutor->id);
        })->count();
        $attendanceRecords = Attendance::whereHas('classSchedule.course', function ($query) use ($tutor) {
            $query->where('tutor_id', $tutor->id);
        })->count();

        return view('dashboard.tutor_dashboard', compact('tutor', 'assignedCourses', 'studentsTaught', 'attendanceRecords'));
    }
}
