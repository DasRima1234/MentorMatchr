@extends('layouts.admin')

@section('title')
    {{ __('Student Dashboard') }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <h3>{{ $enrollments }}</h3>
                <p>{{ __('Courses Enrolled') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <h3>{{ $attendance }}</h3>
                <p>{{ __('Attendance Records') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
