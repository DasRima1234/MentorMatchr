@extends('layouts.admin')

@section('title')
    {{ __('Generate Student Performance Report') }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">{{ __('Select Student for Report') }}</h4>

                {!! Form::open(['route' => 'reports.show', 'method' => 'GET']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('student_id', __('Student'), ['class' => 'form-label']) !!}
                            {!! Form::select('student_id', $students, null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">{{ __('Generate Report') }}</button>
                        <a href="{{ route('reports.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
