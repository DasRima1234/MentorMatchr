@extends('layouts.admin')

@section('title')
    {{ __('Admin Dashboard') }}
@endsection

@section('content')
    <div class="row pt-3">
        <!-- Total Students -->
        <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="widget-stat card rounded-card-shadow">
                <div class="card-body">
                    <div class="media">
                        <span class="me-3 text-primary">
                            <i class="bi bi-people-fill"></i>
                        </span>
                        <div class="media-body">
                            <h3>{{ $totalStudents }}</h3>
                            <p class="text-muted">{{ __('Total Students') }}</p>
                            {{-- <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">Manage Students</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Tutors -->
        <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="widget-stat card rounded-card-shadow">
                <div class="card-body">
                    <div class="media">
                        <span class="me-3 text-primary">
                            <i class="bi bi-person-rolodex"></i>
                        </span>
                        <div class="media-body">
                            <h3>{{ $totalTutors }}</h3>
                            <p class="text-muted">{{ __('Total Tutors') }}</p>
                            {{-- <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">Manage Students</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="widget-stat card rounded-card-shadow">
                <div class="card-body">
                    <div class="media">
                        <span class="me-3 text-primary">
                            <i class="bi bi-book-fill"></i>
                        </span>
                        <div class="media-body">
                            <h3>{{ $totalCourses }}</h3>
                            <p class="text-muted">{{ __('Total Courses') }}</p>
                            {{-- <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">Manage Students</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="widget-stat card rounded-card-shadow">
                <div class="card-body">
                    <div class="media">
                        <span class="me-3 text-primary">
                            <i class="bi bi-bar-chart-fill"></i>
                        </span>
                        <div class="media-body">
                            <h3>{{ $totalEnrollments }}</h3>
                            <p class="text-muted">{{ __('Total Enrollments') }}</p>
                            {{-- <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">Manage Students</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graph for Student Enrollment Trends -->
        <div class="col-md-6">
            <div class="card rounded-card-shadow px-4">
                <div class="card-body">
                    <h5 class="mb-3">{{ __('Enrollment Trends (This Year)') }}</h5>
                    <canvas id="enrollmentChart"></canvas>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5>{{ __('Student Enrollment by Course') }}</h5>
                <canvas id="enrollmentDoughnutChart"></canvas>
            </div>
        </div>
    </div> --}}

        <!-- Recent Payments -->
        <div class="col-md-12">
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
                                @foreach ($recentPayments as $payment)
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
        </div>
    </div>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("enrollmentChart").getContext("2d");
        ctx.height = 250;
        var enrollmentChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                    "Dec"
                ],
                datasets: [{
                        type: 'line', // Line dataset
                        label: 'Enrollment Trend',
                        data: {!! json_encode(array_values($months)) !!},
                        // borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2,
                        borderColor: 'rgb(181, 25, 236)',
                        backgroundColor: 'rgba(181, 25, 236, 0.2)',
                        // pointBorderColor: 'rgba(0, 0, 255)',
                        fill: false,
                        tension: 0.6
                    },
                    {
                        type: 'scatter', // Scatter dataset for dots
                        label: 'Enrollment Points',
                        data: {!! json_encode(array_values($months)) !!}.map((val, index) => ({
                            x: index,
                            y: val
                        })),
                        borderColor: 'rgba(47, 76, 221, 1)',
                        backgroundColor: 'rgba(47, 76, 221, 0.2)',
                        pointRadius: 5, // Scatter point size
                        pointHoverRadius: 7
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        type: 'category',
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            max: 200,
                            min: 0,
                            stepSize: 20
                        }
                    }
                }
            }
        });
        let courseNames = @json($courseNames); // Laravel Blade syntax
        let courseCounts = @json($courseCounts); // Laravel Blade syntax

        // Doughnut Chart
        // var ctx2 = document.getElementById("enrollmentDoughnutChart").getContext("2d");
        // var enrollmentDoughnutChart = new Chart(ctx2, {
        //     type: 'doughnut',
        //     data: {
        //         labels: courseNames,
        //         datasets: [{
        //             label: 'Enrollments',
        //             data: courseCounts,
        //             backgroundColor: [
        //                 '#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#9966FF', '#FFA726'
        //             ],
        //             hoverOffset: 4
        //         }]
        //     },
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: false,
        //         plugins: {
        //             legend: {
        //                 position: 'top'
        //             }
        //         }
        //     }
        // });
    });
</script>
