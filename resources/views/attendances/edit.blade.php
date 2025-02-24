@extends('layouts.admin')

@section('title')
    {{ __('Edit Attendance') }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">{{ __('Edit Attendance Information') }}</h4>

                {!! Form::model($attendance, ['route' => ['attendances.update', $attendance->id], 'method' => 'PUT']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('class_schedule_id', __('Class Schedule'), ['class' => 'form-label']) !!}
                            {!! Form::select('class_schedule_id', $schedules, null, ['class' => 'form-control', 'disabled']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('student_id', __('Student'), ['class' => 'form-label']) !!}
                            {!! Form::select('student_id', $students, null, ['class' => 'form-control', 'disabled']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('status', __('Status'), ['class' => 'form-label']) !!}
                            {!! Form::select('status', ['Present' => 'Present', 'Absent' => 'Absent', 'Late' => 'Late', 'Excused' => 'Excused'], null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('remarks', __('Remarks (Optional)'), ['class' => 'form-label']) !!}
                            {!! Form::textarea('remarks', null, ['class' => 'form-control', 'rows' => 2]) !!}
                        </div>
                    </div>

                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">{{ __('Update Attendance') }}</button>
                        <a href="{{ route('attendances.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
