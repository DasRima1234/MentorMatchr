@extends('layouts.admin')

@section('title')
    {{ __('Admin Dashboard') }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h3>{{ $totalStudents }}</h3>
                <p>{{ __('Total Students') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h3>{{ $totalTutors }}</h3>
                <p>{{ __('Total Tutors') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h3>{{ $totalCourses }}</h3>
                <p>{{ __('Total Courses') }}</p>
            </div>
        </div>
    </div>
</div>

@endsection
