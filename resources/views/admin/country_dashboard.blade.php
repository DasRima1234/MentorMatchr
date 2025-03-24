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
        <div class="col-xl-6 col-xxl-6 col-lg-12 col-md-12">
            <div class="card rounded-card-shadow px-4">
                <div class="card-header d-sm-flex d-flex justify-content-between">
                    <h5 class="mb-3">{{ __('Enrollment Trends (This Year)') }}</h5>
                </div>
                <div class="card-body">
                    <canvas id="enrollmentChart"></canvas>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-6">
        <div class="card rounded-card-shadow px-4">
            <div class="card-body">
                <h5 class="mb-3">{{ __('Student Enrollment by Course') }}</h5>
                <canvas id="doughnut"></canvas>
            </div>
        </div>
    </div> --}}
        @php
            $enrollmentPercentage = $totalAll > 0 ? ($totalEnrollments / $totalAll) * 100 : 0;
            $studentPercentage = $totalAll > 0 ? ($totalStudents / $totalAll) * 100 : 0;
            $coursePercentage = $totalAll > 0 ? ($totalCourses / $totalAll) * 100 : 0;
        @endphp

        <div class="col-xl-6 col-xxl-6 col-lg-12 col-md-12">
            <div class="card rounded-card-shadow px-4">
                <div class="card-header d-sm-flex d-flex justify-content-between">
                    <div>
                        <h4 class="card-title py-0 mb-1">Student Enrollment by Course</h4>
                        {{--  <small class="mb-0">Lorem ipsum dolor sit amet, consectetur</small>  --}}
                    </div>
                    {{-- <div class="card-action card-tabs mt-3 mt-sm-0">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active order-status" data-bs-toggle="tab" data-bs-target="#user" role="tab" aria-selected="true" id="monthly_order_status">
                    {!!trans('pages.Mnthly')!!}
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link order-status" data-bs-toggle="tab" data-bs-target="#bounce" role="tab" aria-selected="false" id="weekly_order_status">
                    {!!trans('pages.Wekly')!!}
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link order-status" data-bs-toggle="tab" data-bs-target="#session-duration" role="tab" aria-selected="false" id="today_order_status">
                    {!!trans('pages.Tody')!!}
                  </a>
                </li>
              </ul>
            </div> --}}

                </div>
                <div class="card-body">
                    <div class="d-flex order-manage p-3 align-items-center mb-3">
                        <a href="{!! URL::to('enrollments') !!}" class="btn fs-22 py-1 btn-success px-4 me-3">20</a>
                        <h4 class="mb-0">New Enrollments <i class="bi bi-circle-fill text-success ms-1 fsize13"></i></h4>
                        <a href="{!! URL::to('enrollments') !!}" class="ms-auto text-primary fw-500">Manage Enrollments <i
                                class=" bi bi-chevron-right ms-1"></i></a>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="user" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-4 mb-4">
                                    <div class="border px-3 py-3 rounded-3" id="status1">
                                        <h2 class="fs-32 fw-bold mb-0">{{ $totalEnrollments }}</h2>
                                        <p class="fs-16 mb-0">Enrolled</p>
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-4">
                                    <div class="border px-3 py-3 rounded-3" id="status2">
                                        <h2 class="fs-32 fw-bold mb-0">{{ $totalStudents }}</h2>
                                        <p class="fs-16 mb-0">Students</p>
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-4">
                                    <div class="border px-3 py-3 rounded-3" id="status3">
                                        <h2 class="fs-32 fw-bold mb-0">{{ $totalCourses }}</h2>
                                        <p class="fs-16 mb-0">Courses</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-xl-4 col-lg-4 col-sm-6 text-center text-sm-start">
                                    <canvas id="doughnut" class="chartjs"></canvas>
                                </div>
                                <div class="col-xl-8 col-lg-8 col-sm-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <p class="mb-0 fs-14 me-2 col-4 px-0" id="enrollments_percentage">Enrollments
                                            ({{ number_format($enrollmentPercentage, 2) }}%)</p>
                                        <div class="progress progress-sm mb-0" style="height:8px; width:100%;">
                                            <div class="progress-bar bg-primary"
                                                style="width: {{ number_format($enrollmentPercentage, 2) }}%; height:8px;"
                                                role="progressbar">
                                            </div>
                                        </div>
                                        <span class="text-end ms-auto col-1 px-0 text-right"
                                            id="enrollments_counts">{{ $totalEnrollments }}</span>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <p class="mb-0 fs-14 me-2 col-4 px-0" id="">Students
                                            ({{ number_format($studentPercentage, 2) }}%)</p>
                                        <div class="progress mb-0" style="height:8px; width:100%;">
                                            <div class="progress-bar bg-success"
                                                style="width: {{ number_format($studentPercentage, 2) }}%; height:8px;"
                                                role="progressbar">
                                            </div>
                                        </div>
                                        <span class="text-end ms-auto col-1px-0 text-right"
                                            id="">{{ $totalStudents }}</span>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <p class="mb-0 fs-14 me-2 col-4 px-0" id="">Courses
                                            ({{ number_format($coursePercentage, 2) }}%)</p>
                                        <div class="progress mb-0" style="height:8px; width:100%;">
                                            <div class="progress-bar bg-secondary"
                                                style="width: {{ number_format($coursePercentage, 2) }}%; height:8px;"
                                                role="progressbar">
                                            </div>
                                        </div>
                                        <span class="text-end ms-auto col-1 px-0 text-right"
                                            id="">{{ $totalCourses }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Payments -->
        {{-- <div class="col-md-12">
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
        </div> --}}

        <div class="col-md-12">
            <div class="card rounded-card-shadow px-4">
                <div class="card-header d-sm-flex d-flex justify-content-between">
                    <h5 class="mb-3">{{ __('Monthly Payment Collection (This Year)') }}</h5>
                </div>
                <div class="card-body">
                    <canvas id="revenue"></canvas>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
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
                    aspectRatio: 1.55,
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


            var chart = document.getElementById("doughnut");
            chart.height = 250;
            chart.getContext('2d');
            var doughnutChart = new Chart(chart, {
                type: 'doughnut',
                data: {
                    // labels: courseNames,
                    datasets: [{
                        label: "Order Status",
                        data: courseCounts, // Initial dummy data
                        backgroundColor: ["#f44336", "#3f51b5", "#4caf50"],
                    }]
                },
                options: {
                    responsive: true,
                    // aspectRatio: 2,
                    legend: false,
                    tooltips: {
                        mode: "index",
                        intersect: false,
                        titleFontColor: "#888",
                        bodyFontColor: "#555",
                        titleFontSize: 12,
                        bodyFontSize: 15,
                        backgroundColor: "rgba(255,255,255,1)",
                        displayColors: true,
                        xPadding: 10,
                        yPadding: 7,
                        borderColor: "rgba(220, 220, 220, 1)",
                        borderWidth: 1,
                        caretSize: 6,
                        caretPadding: 10
                    }
                }
            });


            var charts = document.getElementById("revenue");
            charts.height = 200;
            charts.getContext('2d');
            var doughnutChart = new Chart(charts, {
                type: 'bar',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep",
                        "Oct", "Nov", "Dec"
                    ],
                    datasets: [{
                        label: 'Payments (USD)',
                        data: {!! json_encode(array_values($monthlyRevenue)) !!},
                        backgroundColor: '#4CAF50',
                        borderColor: '#388E3C',
                        borderWidth: "0",
                        barThickness: 'flex',
                        // minBarLength: 10,
                        barPercentage: 0.4,
                        categoryPercentage: 0.6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                color: "rgba(233,236,255,1)",
                                drawBorder: true
                            },
                            ticks: {
                                fontColor: "#3e4954",
                                max: Math.ceil(Math.max(...{!! json_encode(array_values($monthlyRevenue)) !!}) / 5),
                                min: 0,
                                stepSize: 20
                            },
                        }],
                        xAxes: [{
                            barPercentage: 0.3,
                            gridLines: {
                                display: false,
                                zeroLineColor: "transparent"
                            },
                            ticks: {
                                stepSize: 20,
                                fontColor: "#3e4954",
                                fontFamily: "Nunito, sans-serif"
                            }
                        }]
                    },
                    tooltips: {
                        mode: "index",
                        intersect: false,
                        titleFontColor: "#888",
                        bodyFontColor: "#555",
                        titleFontSize: 12,
                        bodyFontSize: 15,
                        backgroundColor: "rgba(255,255,255,1)",
                        displayColors: true,
                        xPadding: 10,
                        yPadding: 7,
                        borderColor: "rgba(220, 220, 220, 1)",
                        borderWidth: 1,
                        caretSize: 6,
                        caretPadding: 10
                    }
                }
            });


        });
    </script>
@endpush
