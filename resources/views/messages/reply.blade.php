@extends('layouts.admin')

@section('title')
    {{ __('Reply to Message') }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">{{ __('Reply to Message') }}</h4>

                {!! Form::open(['route' => 'messages.store', 'method' => 'POST']) !!}
                {!! Form::hidden('receiver_id', $message->sender->id) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>{{ __('To:') }}</strong> {{ $message->sender->name }}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('message', __('Your Reply'), ['class' => 'form-label']) !!}
                            {!! Form::textarea('message', null, ['class' => 'form-control', 'rows' => 4, 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">{{ __('Send Reply') }}</button>
                        <a href="{{ route('messages.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
