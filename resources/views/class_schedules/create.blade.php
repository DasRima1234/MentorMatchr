@extends('layouts.admin')

@section('title')
    {{ __('Add Class Schedule') }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">{{ __('Class Schedule Information') }}</h4>

                {!! Form::open(['route' => 'class_schedules.store', 'method' => 'POST']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('course_id', __('Course'), ['class' => 'form-label']) !!}
                            {!! Form::select('course_id', $courses, null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('tutor_id', __('Tutor'), ['class' => 'form-label']) !!}
                            {!! Form::select('tutor_id', $tutors, null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('date', __('Date'), ['class' => 'form-label']) !!}
                            {!! Form::date('date', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('start_time', __('Start Time'), ['class' => 'form-label']) !!}
                            {!! Form::time('start_time', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('end_time', __('End Time'), ['class' => 'form-label']) !!}
                            {!! Form::time('end_time', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('recurrence', __('Recurrence'), ['class' => 'form-label']) !!}
                            {!! Form::select('recurrence', ['Daily' => 'Daily', 'Weekly' => 'Weekly', 'Monthly' => 'Monthly'], null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('status', __('Status'), ['class' => 'form-label']) !!}
                            {!! Form::select('status', ['Scheduled' => 'Scheduled', 'Completed' => 'Completed', 'Cancelled' => 'Cancelled'], 'Scheduled', ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">{{ __('Save Schedule') }}</button>
                        <a href="{{ route('class_schedules.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
