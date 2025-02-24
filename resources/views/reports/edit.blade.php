@extends('layouts.admin')

@section('title')
    {{ __('Edit Student Report for ') . $student->first_name }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">{{ __('Edit Student Performance Report') }}</h4>

                {!! Form::model($student, ['route' => ['reports.update', $student->id], 'method' => 'PUT']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('student_id', __('Student'), ['class' => 'form-label']) !!}
                            {!! Form::select('student_id', $students, $student->id, ['class' => 'form-control', 'disabled']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('remarks', __('Overall Remarks'), ['class' => 'form-label']) !!}
                            {!! Form::textarea('remarks', null, ['class' => 'form-control', 'rows' => 3, 'required']) !!}
                        </div>
                    </div>

                    <h4 class="mb-4">{{ __('Update Exam Grades') }}</h4>
                    @foreach($grades as $grade)
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('score['.$grade->id.']', $grade->exam->exam_name, ['class' => 'form-label']) !!}
                                {!! Form::number('score['.$grade->id.']', $grade->score, ['class' => 'form-control', 'step' => '0.01', 'required']) !!}
                            </div>
                        </div>
                    @endforeach

                    <h4 class="mb-4">{{ __('Update Attendance Status') }}</h4>
                    @foreach($attendance as $attend)
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('attendance['.$attend->id.']', $attend->classSchedule->date, ['class' => 'form-label']) !!}
                                {!! Form::select('attendance['.$attend->id.']', ['Present' => 'Present', 'Absent' => 'Absent', 'Late' => 'Late', 'Excused' => 'Excused'], $attend->status, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                    @endforeach

                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">{{ __('Update Report') }}</button>
                        <a href="{{ route('reports.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
