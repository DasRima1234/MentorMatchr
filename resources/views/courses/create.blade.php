@extends('layouts.admin')

@section('title')
    {{ __('Add Course') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">{{ __('Course Information') }}</h4>

                    {!! Form::open(['route' => 'courses.store', 'method' => 'POST']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('course_name', __('Course Name'), ['class' => 'form-label']) !!}
                                {!! Form::text('course_name', null, ['class' => 'form-control', 'required']) !!}
                                @error('course_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
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
                                {!! Form::label('fee', __('Course Fee'), ['class' => 'form-label']) !!}
                                {!! Form::number('fee', null, ['class' => 'form-control', 'step' => '1', 'required']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('tutor_id', __('Assign Tutor'), ['class' => 'form-label']) !!}
                                {!! Form::select('tutor_id', $tutors, null, ['class' => 'form-control select2']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('description', __('Course Description'), ['class' => 'form-label']) !!}
                                {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3, 'style' => 'height: 300px;']) !!}
                            </div>
                        </div>

                        {{-- <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('status', __('Status'), ['class' => 'form-label']) !!}
                            {!! Form::select('status', ['Active' => 'Active', 'Inactive' => 'Inactive'], 'Active', ['class' => 'form-control']) !!}
                        </div>
                    </div> --}}

                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary">{{ __('Save Course') }}</button>
                            <a href="{{ route('courses.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
