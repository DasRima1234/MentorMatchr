@extends('layouts.admin')

@section('title')
    {{ __('Tutor Dashboard') }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h3>{{ $assignedCourses }}</h3>
                <p>{{ __('Assigned Courses') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h3>{{ $studentsTaught }}</h3>
                <p>{{ __('Students Taught') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h3>{{ $attendanceRecords }}</h3>
                <p>{{ __('Attendance Records Managed') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
