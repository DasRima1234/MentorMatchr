@extends('layouts.admin')

@section('title')
    {{ __('Add Payment') }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">{{ __('Payment Information') }}</h4>

                {!! Form::open(['route' => 'payments.store', 'method' => 'POST']) !!}
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
                            {!! Form::label('amount', __('Amount ($)'), ['class' => 'form-label']) !!}
                            {!! Form::number('amount', null, ['class' => 'form-control', 'step' => '0.01', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('payment_method', __('Payment Method'), ['class' => 'form-label']) !!}
                            {!! Form::select('payment_method', ['Cash' => 'Cash', 'Card' => 'Card', 'PayPal' => 'PayPal'], null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('status', __('Status'), ['class' => 'form-label']) !!}
                            {!! Form::select('status', ['Pending' => 'Pending', 'Completed' => 'Completed', 'Failed' => 'Failed'], 'Pending', ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('payment_date', __('Payment Date'), ['class' => 'form-label']) !!}
                            {!! Form::date('payment_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">{{ __('Save Payment') }}</button>
                        <a href="{{ route('payments.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
