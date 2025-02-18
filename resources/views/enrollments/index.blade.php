@extends('layouts.admin')

@section('title')
    {{ __('Manage Enrollments') }}
@endsection

@section('action-button')
<div class="all-button-box row d-flex justify-content-end">
    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
        <a href="{{ route('enrollments.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
            <i class="fas fa-plus"></i> {{ __('Add Enrollment') }}
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
                                    <th>{{ __('Student') }}</th>
                                    <th>{{ __('Course') }}</th>
                                    <th>{{ __('Enrollment Date') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($enrollments as $enrollment)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $enrollment->student->first_name }}</td>
                                        <td>{{ $enrollment->course->course_name }}</td>
                                        <td>{{ $enrollment->enrollment_date }}</td>
                                        <td>{{ $enrollment->status }}</td>
                                        <td class="d-flex user-icon">
                                            <a href="{{ route('enrollments.edit', $enrollment->id) }}" class="edit-icon" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="#" class="delete-icon" data-confirm="{{ __('Are You Sure?').'|'.__('This action cannot be undone. Do you want to continue?') }}" data-confirm-yes="document.getElementById('delete-form-{{ $enrollment->id }}').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['enrollments.destroy', $enrollment->id], 'id' => 'delete-form-'.$enrollment->id]) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $enrollments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
