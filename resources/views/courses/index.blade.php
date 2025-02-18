@extends('layouts.admin')

@section('title')
    {{ __('Manage Courses') }}
@endsection

@section('action-button')
<div class="all-button-box row d-flex justify-content-end">
    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
        <a href="{{ route('courses.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
            <i class="fas fa-plus"></i> {{ __('Add Course') }}
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
                                    <th>{{ __('Course Name') }}</th>
                                    <th>{{ __('Duration') }}</th>
                                    <th>{{ __('Fee ($)') }}</th>
                                    <th>{{ __('Tutor') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($courses as $course)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $course->course_name }}</td>
                                        <td>{{ $course->duration }}</td>
                                        <td>${{ number_format($course->fee, 2) }}</td>
                                        <td>{{ $course->tutor->name ?? 'N/A' }}</td>
                                        <td>{{ $course->status }}</td>
                                        <td class="d-flex user-icon">
                                            <a href="{{ route('courses.edit', $course->id) }}" class="edit-icon" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="#" class="delete-icon" data-confirm="{{ __('Are You Sure?').'|'.__('This action cannot be undone. Do you want to continue?') }}" data-confirm-yes="document.getElementById('delete-form-{{ $course->id }}').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['courses.destroy', $course->id], 'id' => 'delete-form-'.$course->id]) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
