@extends('layouts.admin')

@section('title')
    {{ $student->first_name . __("'s Detail") }}
@endsection

@push('head')
    <link rel="stylesheet" href="{{ asset('assets/libs/summernote/summernote-bs4.css') }}">
@endpush

@push('script')
    <script src="{{ asset('assets/libs/summernote/summernote-bs4.js') }}"></script>
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12">
            <div class="card profile-card">
                <div class="icon-user avatar rounded-circle">
                    <img
                        @if ($student->avatar) src="{{ asset('/storage/avatars/' . $student->avatar) }}" @else src="{{ asset('assets/img/avatar/avatar-1.png') }}" @endif>
                </div>
                {{-- <h4 class="h4 mb-0 mt-2">{{ $student->fname }} {{ $student->mid_name }} {{ $student->lname }}</h4> --}}
                <h4 class="h4 mb-0 mt-2">{{ $student->name }}</h4>
                <div class="sal-right-card">
                    <span class="badge badge-pill badge-red">{{ $student->type }}</span>
                </div>
                <h6 class="office-time mb-0 mt-4">{{ $student->email }}</h6>
                @if ($student->avatar != '')
                    <div class="mt-4">
                        <a href="#" class="delete-icon" data-toggle="tooltip"
                            data-original-title="{{ __('Delete Profile Photo') }}"
                            onclick="document.getElementById('delete_avatar').submit();"><i class="fas fa-trash"></i></a>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12">
            <section class="col-lg-12 pricing-plan card">
                <div class="our-system password-card p-3">
                    <div class="row">
                        <ul class="nav nav-tabs my-4">
                            <li>
                                <a data-toggle="tab" href="#personal_info" class="active">{{ __('Personal info') }}</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#academic_info" class="">{{ __('Academic info') }}</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#guardian_info" class="">{{ __('Guardian info') }}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="personal_info" class="tab-pane in active">
                                <form method="post" action="" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                <div class="col-md-6 mb-3"><strong>Phone:</strong> {{ $student->phone }}
                                                </div>
                                                <div class="col-md-6 mb-3"><strong>Date of Birth:</strong>
                                                    {{ $student->dob }}</div>
                                                <div class="col-md-6 mb-3"><strong>City:</strong> {{ $student->city }}
                                                </div>
                                                <div class="col-md-6 mb-3"><strong>Country:</strong>
                                                    {{ $student->country }}</div>
                                                <div class="col-md-12 mb-3"><strong>Address:</strong>
                                                    {{ $student->address }}</div>

                                            </div>
                                        </div>

                                    </div>
                                </form>
                                @if ($student->avatar != '')
                                    <form action="" method="post" id="delete_avatar">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endif
                            </div>
                            <div id="academic_info" class="tab-pane">
                                <div class="row">
                                    <div class="col-md-6 mb-3"><strong>School:</strong> {{ $student->school_name }}</div>
                                    <div class="col-md-6 mb-3"><strong>Education Level:</strong>
                                        {{ $student->education_level }}</div>
                                    <div class="col-md-12 mb-3">
                                        <strong>Subjects:</strong>
                                        @if ($student->subjects)
                                            {{ implode(', ', json_decode($student->subjects, true)) }}
                                        @endif
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <strong>Skills:</strong>
                                        @if ($student->skills)
                                            {{ implode(', ', json_decode($student->skills, true)) }}
                                        @endif
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <strong>Interests:</strong> {{ $student->interests }}
                                    </div>
                                </div>
                            </div>
                            <div id="guardian_info" class="tab-pane">
                                <div class="row">
                                    <div class="col-md-6 mb-3"><strong>Guardian Name:</strong>
                                        {{ $student->guardian_name }}</div>
                                    <div class="col-md-12 mb-3"><strong>Guardian Phone:</strong>
                                        {{ $student->guardian_phone }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- Timeline Section -->
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">📚 Learning Timeline</h5>
        </div>
        <div class="card-body">
            <ul class="timeline">
                @forelse($courses as $course)
                    <li>
                        <strong>{{ \Carbon\Carbon::parse($course->created_at)->format('M Y') }}:</strong>
                        Joined "{{ $course->course_name }}"
                        @if ($course->tutor)
                            with {{ $course->tutor->name }}
                        @endif
                    </li>
                @empty
                    <li>No course history found.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <style>
        .timeline {
            list-style: none;
            padding-left: 0;
            border-left: 2px solid #007bff;
            margin-left: 20px;
        }
        .timeline li {
            position: relative;
            padding-left: 20px;
            margin-bottom: 15px;
        }
        .timeline li::before {
            content: '';
            position: absolute;
            left: -7px;
            top: 6px;
            width: 12px;
            height: 12px;
            background-color: #007bff;
            border-radius: 50%;
        }
    </style>
    
@endsection
