@extends('layouts.admin')

@section('title')
    {{ __('Edit Class Schedule') }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">{{ __('Edit Class Schedule') }}</h4>

                {!! Form::model($schedule, ['route' => ['class_schedules.update', $schedule->id], 'method' => 'PUT']) !!}
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

                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">{{ __('Update Schedule') }}</button>
                        <a href="{{ route('class_schedules.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
