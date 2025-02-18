@extends('layouts.admin')

@section('title')
    {{ __('Add Enrollment') }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">{{ __('Enrollment Information') }}</h4>

                {!! Form::open(['route' => 'enrollments.store', 'method' => 'POST']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('student_id', __('Student'), ['class' => 'form-label']) !!}
                            {!! Form::select('student_id', $students, null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('course_id', __('Course'), ['class' => 'form-label']) !!}
                            {!! Form::select('course_id', $courses, null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('enrollment_date', __('Enrollment Date'), ['class' => 'form-label']) !!}
                            {!! Form::date('enrollment_date', \Carbon\Carbon::now(), ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('status', __('Status'), ['class' => 'form-label']) !!}
                            {!! Form::select('status', ['Pending' => 'Pending', 'Active' => 'Active', 'Completed' => 'Completed', 'Cancelled' => 'Cancelled'], 'Pending', ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">{{ __('Save Enrollment') }}</button>
                        <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
