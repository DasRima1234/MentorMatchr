@extends('layouts.admin')

@section('title')
    {{ __('Edit Course') }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">{{ __('Edit Course') }}</h4>

                {!! Form::model($course, ['route' => ['courses.update', $course->id], 'method' => 'PUT']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('course_name', __('Course Name'), ['class' => 'form-label']) !!}
                            {!! Form::text('course_name', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('duration', __('Duration'), ['class' => 'form-label']) !!}
                            {!! Form::text('duration', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('fee', __('Fee ($)'), ['class' => 'form-label']) !!}
                            {!! Form::number('fee', null, ['class' => 'form-control', 'step' => '0.01', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('tutor_id', __('Assign Tutor'), ['class' => 'form-label']) !!}
                            {!! Form::select('tutor_id', $tutors, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">{{ __('Update Course') }}</button>
                        <a href="{{ route('courses.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
