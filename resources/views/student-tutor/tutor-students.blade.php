@extends('layouts.admin')

@section('title')
    {{ __('Tutor - Student Assignments') }}
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
                                    <th>{{ __('Tutor Name') }}</th>
                                    <th>{{ __('Students Assigned') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($tutors))
                                @foreach($tutors as $tutor)
                                    <tr>
                                        <td>{{ $tutor->name }}</td>
                                        <td>
                                            @foreach($tutor->students as $student)
                                                {{ $student->first_name }},
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($tutor->students as $student)
                                                <form action="{{ route('student-tutors.destroy', $student->id . '-' . $tutor->id) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">{{ __('Remove') }}</button>
                                                </form>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
