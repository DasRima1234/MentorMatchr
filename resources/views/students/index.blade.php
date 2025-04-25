@extends('layouts.admin')

@section('title')
    {{ __('Manage Students') }}
@endsection

@section('action-button')
<div class="all-button-box row d-flex justify-content-end">
    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
        <a href="{{ route('students.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
            <i class="fas fa-plus"></i> {{ __('Add Student') }}
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
                                    <th>{{ __('Education Level') }}</th>
                                    <th>{{ __('Guardian Name') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>{{ $student->phone }}</td>
                                        <td>{{ $student->city }}</td>
                                        <td>{{ $student->education_level }}</td>
                                        <td>{{ $student->guardian_name }}</td>
                                        <td class="d-flex user-icon">
                                            <a href="{{ route('students.show', $student->id) }}" class="view-icon" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('students.edit', $student->id) }}" class="edit-icon" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="#" class="delete-icon delete-student" data-id="{{ $student->id }}" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['students.destroy', $student['id']], 'id' => 'delete-form-'.$student['id']]) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-student').forEach(function (button) {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const studentId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + studentId).submit();
                    }
                });
            });
        });
    });
</script>
@endsection
