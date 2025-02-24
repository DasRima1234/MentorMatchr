@extends('layouts.admin')

@section('title')
    {{ __('Performance Report for ') . $student->first_name }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">{{ __('Student Information') }}</h4>
                <p><strong>{{ __('Name:') }}</strong> {{ $student->first_name }} {{ $student->last_name }}</p>
                <p><strong>{{ __('Email:') }}</strong> {{ $student->email }}</p>
                
                <h4 class="mb-4">{{ __('Exam Grades') }}</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('Exam Name') }}</th>
                            <th>{{ __('Score') }}</th>
                            <th>{{ __('Grade') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($grades as $grade)
                            <tr>
                                <td>{{ $grade->exam->exam_name }}</td>
                                <td>{{ $grade->score }}</td>
                                <td>{{ $grade->grade }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h4 class="mb-4">{{ __('Attendance Record') }}</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendance as $attend)
                            <tr>
                                <td>{{ $attend->classSchedule->date }}</td>
                                <td>{{ $attend->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="col-md-12 text-right">
                    <a href="{{ route('reports.pdf', $student->id) }}" class="btn btn-primary">
                        <i class="fas fa-file-pdf"></i> {{ __('Download PDF') }}
                    </a>
                    <a href="{{ route('reports.index') }}" class="btn btn-secondary">{{ __('Back to Reports') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
