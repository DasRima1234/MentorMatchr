@extends('layouts.admin')

@section('title')
    {{ __('Manage Exams') }}
@endsection

@section('action-button')
<div class="all-button-box row d-flex justify-content-end">
    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
        <a href="{{ route('exams.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
            <i class="fas fa-plus"></i> {{ __('Add Exam') }}
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
                                    <th>{{ __('Exam Name') }}</th>
                                    <th>{{ __('Course') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($exams as $exam)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $exam->exam_name }}</td>
                                        <td>{{ $exam->course->course_name }}</td>
                                        <td>{{ $exam->exam_date }}</td>
                                        <td class="d-flex user-icon">
                                            <a href="{{ route('exams.edit', $exam->id) }}" class="edit-icon" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="#" class="delete-icon" data-confirm="{{ __('Are You Sure?') }}" data-confirm-yes="document.getElementById('delete-form-{{ $exam->id }}').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['exams.destroy', $exam->id], 'id' => 'delete-form-'.$exam->id]) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $exams->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
