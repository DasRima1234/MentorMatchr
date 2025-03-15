@extends('layouts.admin')

@section('title')
    {{ __('Admin Dashboard') }}
@endsection

@section('content')
<div class="row">
    <!-- Total Students -->
    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h4>{{ $totalStudents }}</h4>
                <p class="text-muted">{{ __('Total Students') }}</p>
                <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">Manage Students</a>
            </div>
        </div>
    </div>

    <!-- Total Tutors -->
    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h4>{{ $totalTutors }}</h4>
                <p class="text-muted">{{ __('Total Tutors') }}</p>
                <a href="{{ route('tutors.index') }}" class="btn btn-primary btn-sm">Manage Tutors</a>
            </div>
        </div>
    </div>

    <!-- Total Courses -->
    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h4>{{ $totalCourses }}</h4>
                <p class="text-muted">{{ __('Total Courses') }}</p>
                <a href="{{ route('courses.index') }}" class="btn btn-primary btn-sm">Manage Courses</a>
            </div>
        </div>
    </div>

    <!-- Total Enrollments -->
    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h4>{{ $totalEnrollments }}</h4>
                <p class="text-muted">{{ __('Total Enrollments') }}</p>
                <a href="{{ route('enrollments.index') }}" class="btn btn-primary btn-sm">Manage Enrollments</a>
            </div>
        </div>
    </div>
</div>

<!-- Graph for Student Enrollment Trends -->
<div class="card shadow-sm mt-4">
    <div class="card-body">
        <h5 class="mb-3">{{ __('Enrollment Trends (This Year)') }}</h5>
        <canvas id="enrollmentChart"></canvas>
    </div>
</div>

<!-- Recent Payments -->
<div class="card shadow-sm mt-4">
    <div class="card-body">
        <h5 class="mb-3">{{ __('Recent Payments') }}</h5>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('Student') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentPayments as $payment)
                        <tr>
                            <td>{{ $payment->student->first_name }}</td>
                            <td>${{ number_format($payment->amount, 2) }}</td>
                            <td>{{ $payment->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
<script>
  document.addEventListener("DOMContentLoaded", function() {
      var ctx = document.getElementById("enrollmentChart").getContext("2d");
      var enrollmentChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
              datasets: [{
                  label: 'Enrollments',
                  data: {!! json_encode(array_values($months)) !!}, // Fixed data format
                  backgroundColor: 'rgba(54, 162, 235, 0.5)',
                  borderColor: 'rgba(54, 162, 235, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
              scales: {
                  y: { beginAtZero: true }
              }
          }
      });
  });
</script>
