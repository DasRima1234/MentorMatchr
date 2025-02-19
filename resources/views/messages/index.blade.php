@extends('layouts.admin')

@section('title')
    {{ __('Inbox Messages') }}
@endsection

@section('action-button')
<div class="all-button-box row d-flex justify-content-end">
    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
        <a href="{{ route('messages.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
            <i class="fas fa-envelope"></i> {{ __('Compose Message') }}
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="UserTable">
                    <div class="table-responsive">
                        <table class="table table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>{{ __('No') }}</th>
                                    <th>{{ __('Sender') }}</th>
                                    <th>{{ __('Message') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($messages as $message)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $message->sender->name }}</td>
                                        <td>{{ Str::limit($message->message, 50) }}</td>
                                        <td>{{ $message->status }}</td>
                                        <td class="d-flex user-icon">
                                            <a href="{{ route('messages.show', $message->id) }}" class="view-icon" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="{{ route('messages.destroy', $message->id) }}" method="POST" style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $messages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
