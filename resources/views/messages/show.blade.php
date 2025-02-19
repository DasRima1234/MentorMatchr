@extends('layouts.admin')

@section('title')
    {{ __('View Message') }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">{{ __('Message Details') }}</h4>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>{{ __('From:') }}</strong> {{ $message->sender->name }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>{{ __('To:') }}</strong> {{ $message->receiver->name }}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>{{ __('Message:') }}</strong>
                            <p class="mt-2">{{ $message->message }}</p>
                        </div>
                    </div>

                    <div class="col-md-12 text-right">
                        <a href="{{ route('messages.index') }}" class="btn btn-secondary">{{ __('Back to Inbox') }}</a>
                        <form action="{{ route('messages.destroy', $message->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
