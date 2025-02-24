@extends('layouts.admin')

@section('title')
    {{ __('Dashboard') }}
@endsection

@section('content')
<div class="row">
    <!-- Total Students -->
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h3>{{ $totalStudents }}</h3>
                <p>{{ __('Total Students') }}</p>
            </div>
        </div>
    </div>

    <!-- Total Tutors -->
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h3>{{ $totalTutors }}</h3>
                <p>{{ __('Total Tutors') }}</p>
            </div>
        </div>
    </div>

    <!-- Total Courses -->
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h3>{{ $totalCourses }}</h3>
                <p>{{ __('Total Courses') }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Total Enrollments -->
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h3>{{ $totalEnrollments }}</h3>
                <p>{{ __('Total Enrollments') }}</p>
            </div>
        </div>
    </div>

    <!-- Total Revenue -->
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h3>${{ number_format($totalPayments, 2) }}</h3>
                <p>{{ __('Total Revenue') }}</p>
            </div>
        </div>
    </div>

    <!-- Total Attendance Records -->
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h3>{{ $totalAttendances }}</h3>
                <p>{{ __('Total Attendance Records') }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Enrollment Chart -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4>{{ __('Monthly Enrollments') }}</h4>
                <canvas id="enrollmentChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Revenue Chart -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4>{{ __('Monthly Revenue') }}</h4>
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var enrollmentChart = document.getElementById('enrollmentChart').getContext('2d');
    var revenueChart = document.getElementById('revenueChart').getContext('2d');

    new Chart(enrollmentChart, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($monthlyEnrollments->toArray())) !!},
            datasets: [{
                label: '{{ __("Enrollments") }}',
                data: {!! json_encode(array_values($monthlyEnrollments->toArray())) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.6)'
            }]
        }
    });

    new Chart(revenueChart, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($monthlyRevenue->toArray())) !!},
            datasets: [{
                label: '{{ __("Revenue ($)") }}',
                data: {!! json_encode(array_values($monthlyRevenue->toArray())) !!},
                backgroundColor: 'rgba(255, 99, 132, 0.6)'
            }]
        }
    });
</script>
@endsection
