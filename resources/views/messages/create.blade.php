@extends('layouts.admin')

@section('title')
    {{ __('Compose Message') }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">{{ __('New Message') }}</h4>

                {!! Form::open(['route' => 'messages.store', 'method' => 'POST']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('receiver_id', __('Recipient'), ['class' => 'form-label']) !!}
                            {!! Form::select('receiver_id', $users, null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('message', __('Message'), ['class' => 'form-label']) !!}
                            {!! Form::textarea('message', null, ['class' => 'form-control', 'rows' => 4, 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">{{ __('Send Message') }}</button>
                        <a href="{{ route('messages.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
