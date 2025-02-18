@extends('layouts.admin')

@section('title')
    {{ __('Manage Tutors') }}
@endsection

@section('action-button')
<div class="all-button-box row d-flex justify-content-end">
    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
        <a href="{{ route('tutors.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
            <i class="fas fa-plus"></i> {{ __('Add Tutor') }}
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
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Phone') }}</th>
                                    <th>{{ __('City') }}</th>
                                    <th>{{ __('Subject Specialization') }}</th>
                                    <th>{{ __('Experience (Years)') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($tutors as $tutor)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $tutor->name}}</td>
                                        <td>{{ $tutor->email }}</td>
                                        <td>{{ $tutor->phone }}</td>
                                        <td>{{ $tutor->city }}</td>
                                        <td>{{ $tutor->subject_specialization }}</td>
                                        <td>{{ $tutor->experience }}</td>
                                        <td class="d-flex user-icon">
                                            <a href="{{ route('tutors.show', $tutor->id) }}" class="view-icon" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('tutors.edit', $tutor->id) }}" class="edit-icon" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="#" class="delete-icon" data-confirm="{{ __('Are You Sure?').'|'.__('This action cannot be undone. Do you want to continue?') }}" data-confirm-yes="document.getElementById('delete-form-{{ $tutor['id'] }}').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['tutors.destroy', $tutor['id']], 'id' => 'delete-form-'.$tutor['id']]) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $tutors->links() }} <!-- Pagination -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
