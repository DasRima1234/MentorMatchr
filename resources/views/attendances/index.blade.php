@extends('layouts.admin')

@section('title')
    {{ __('Manage Attendance') }}
@endsection

@section('action-button')
<div class="all-button-box row d-flex justify-content-end">
    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
        <a href="{{ route('attendances.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
            <i class="fas fa-plus"></i> {{ __('Mark Attendance') }}
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
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($attendances as $attendance)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $attendance->student->first_name }}</td>
                                        <td>{{ $attendance->classSchedule->course->course_name }}</td>
                                        <td>{{ $attendance->classSchedule->date }}</td>
                                        <td>{{ $attendance->status }}</td>
                                        <td class="d-flex user-icon">
                                            <a href="{{ route('attendances.edit', $attendance->id) }}" class="edit-icon" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $attendances->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
