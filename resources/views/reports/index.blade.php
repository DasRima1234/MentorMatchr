@extends('layouts.admin')

@section('title')
    {{ __('Student Performance Reports') }}
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
                                        <th>{{ __('Student Name') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 0; @endphp
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                            <td class="d-flex user-icon">
                                                <a href="{{ route('reports.show', $student->id) }}" class="view-icon"
                                                    title="View Report">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('reports.pdf', $student->id) }}" class="download-icon"
                                                    title="Download PDF">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($students instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                {{ $students->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
