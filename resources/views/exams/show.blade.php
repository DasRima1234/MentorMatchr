@extends('layouts.admin')

@section('title')
    {{ __('Manage Grades') }}
@endsection

@section('action-button')
<div class="all-button-box row d-flex justify-content-end">
    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
        <a href="{{ route('grades.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
            <i class="fas fa-plus"></i> {{ __('Add Grade') }}
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
                                    <th>{{ __('Exam') }}</th>
                                    <th>{{ __('Score') }}</th>
                                    <th>{{ __('Grade') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($grades as $grade)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $grade->student->first_name }}</td>
                                        <td>{{ $grade->exam->exam_name }}</td>
                                        <td>{{ $grade->score }}</td>
                                        <td>{{ $grade->grade }}</td>
                                        <td class="d-flex user-icon">
                                            <a href="{{ route('grades.edit', $grade->id) }}" class="edit-icon" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="#" class="delete-icon" data-confirm="{{ __('Are You Sure?') }}" data-confirm-yes="document.getElementById('delete-form-{{ $grade->id }}').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['grades.destroy', $grade->id], 'id' => 'delete-form-'.$grade->id]) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $grades->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
