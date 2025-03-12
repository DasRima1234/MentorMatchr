@extends('layouts.admin')

@section('title')
    {{ __('Student-Tutor Management') }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">{{ __('Assign Student to Tutor') }}</h4>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Assign Student to Tutor Form -->
                <form action="{{ route('student-tutors.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="student_id">{{ __('Select Student') }}</label>
                                <select name="student_id" class="form-control" required>
                                    <option value="">-- Select Student --</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->first_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="tutor_id">{{ __('Select Tutor') }}</label>
                                <select name="tutor_id" class="form-control" required>
                                    <option value="">-- Select Tutor --</option>
                                    @foreach($tutors as $tutor)
                                        <option value="{{ $tutor->id }}">{{ $tutor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary mt-4">{{ __('Assign Student') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- List of Assigned Students & Tutors -->
        <div class="card mt-4">
            <div class="card-body">
                <h4 class="mb-4">{{ __('Assigned Students & Tutors') }}</h4>

                <div class="table-responsive">
                    <table class="table table-striped dataTable">
                        <thead>
                            <tr>
                                <th>{{ __('Tutor Name') }}</th>
                                <th>{{ __('Assigned Students') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assignments as $tutor)
                                <tr>
                                    <td>{{ $tutor->name }}</td>
                                    <td>
                                        @foreach($tutor->students as $student)
                                            <span class="badge badge-info">{{ $student->first_name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($tutor->students as $student)
                                            <form action="{{ route('student-tutors.destroy', [$student->id, $tutor->id]) }}" method="POST" style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">{{ __('Remove') }}</button>
                                            </form>
                                        @endforeach
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
@endsection
