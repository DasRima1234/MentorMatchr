@extends('layouts.admin')

@section('title')
    {{ __('Edit Tutor') }}
@endsection

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow p-4 w-100" style="max-width: 1100px; border-radius: 20px;">
        <h3 class="mb-4 pb-2 border-bottom text-primary fw-bold">{{ __('Tutor Information') }}</h3>

                {!! Form::model($tutor, ['route' => ['tutors.update', $tutor->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                <div class="row g-4">
                    <!-- Name -->
                    {{-- <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('first_name', __('First Name'), ['class' => 'form-label']) !!}
                            {!! Form::text('first_name', $tutor->first_name, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('middle_name', __('Middle Name'), ['class' => 'form-label']) !!}
                            {!! Form::text('middle_name', $tutor->middle_name, ['class' => 'form-control']) !!}
                        </div>
                    </div> --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('name', __('Name'), ['class' => 'form-label']) !!}
                            {!! Form::text('name', $tutor->name, ['class' => 'form-control inputTextBox','max'=>50]) !!}
                        </div>
                    </div>

                    <!-- Email & Phone -->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('email', __('Email'), ['class' => 'form-label']) !!}
                            {!! Form::email('email', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('phone', __('Phone'), ['class' => 'form-label']) !!}
                            {!! Form::text('phone', null, ['class' => 'form-control mobileNumber','max'=>15]) !!}
                        </div>
                    </div>

                    <!-- Gender & DOB -->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('gender', __('Gender'), ['class' => 'form-label']) !!}
                            {!! Form::select('gender', ['Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'], null, ['class' => 'form-control select2']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('dob', __('Date of Birth'), ['class' => 'form-label']) !!}
                            {!! Form::date('dob', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <!-- Qualification & Experience -->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('qualification', __('Qualification'), ['class' => 'form-label']) !!}
                            {!! Form::text('qualification', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('experience', __('Experience (Years)'), ['class' => 'form-label']) !!}
                            {!! Form::number('experience', null, ['class' => 'form-control', 'min' => 0]) !!}
                        </div>
                    </div>

                    <!-- Subject Specialization -->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('subject_specialization', __('Subject Specialization'), ['class' => 'form-label']) !!}
                            {!! Form::textarea('subject_specialization', null, ['class' => 'form-control', 'rows' => 3]) !!}
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('city', __('City'), ['class' => 'form-label']) !!}
                            {!! Form::text('city', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('state', __('State'), ['class' => 'form-label']) !!}
                            {!! Form::text('state', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="country" class="form-label">Country</label>
                            <select name="country" id="country" class="form-control select2">
                                {!! \App\Helper\HelperFacades::getCountryDropdown($tutor->country) !!}
                            </select>
                            @error('country')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Hourly Rate -->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('hourly_rate', __('Hourly Rate (₹)'), ['class' => 'form-label']) !!}
                            {!! Form::number('hourly_rate', null, ['class' => 'form-control', 'step' => '1','min'=>0]) !!}
                        </div>
                    </div>

                    <!-- Profile Picture -->
                    {{-- <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('profile_picture', __('Profile Picture'), ['class' => 'form-label']) !!}
                            {!! Form::file('profile_picture', ['class' => 'form-control']) !!}
                            @if($tutor->profile_picture)
                                <img src="{{ asset('storage/'.$tutor->profile_picture) }}" alt="Tutor Profile" width="80" class="mt-2">
                            @endif
                        </div>
                    </div> --}}

                    <!-- Status -->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('status', __('Status'), ['class' => 'form-label']) !!}
                            {!! Form::select('status', ['Active' => 'Active', 'Inactive' => 'Inactive', 'Pending' => 'Pending'], null, ['class' => 'form-control select2']) !!}
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">{{ __('Update Tutor') }}</button>
                        <a href="{{ route('tutors.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        $(".inputTextBoxWithNumber").on(
            "keypress keyup blur change",
            function(event) {
                var regex = new RegExp("^[a-zA-Z0-9 ]+$");
                var key = String.fromCharCode(
                    !event.charCode ? event.which : event.charCode
                );
                $(this).val(
                    $(this)
                    .val()
                    .replace(/[^a-zA-Z0-9 \.]/g, "")
                );
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            }
        );

        $(".inputTextBox").on("keypress keyup blur change", function(event) {
            var regex = new RegExp("^[a-zA-Z ]+$");
            var key = String.fromCharCode(
                !event.charCode ? event.which : event.charCode
            );
            $(this).val(
                $(this)
                .val()
                .replace(/[^a-zA-Z \.]/g, "")
            );
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });

        $(".mobileNumber").on("keypress keyup blur change", function(event) {
            var regex = /^[\d+ ]*$/;
            var key = String.fromCharCode(
                !event.charCode ? event.which : event.charCode
            );
            $(this).val(
                $(this)
                .val()
                .replace(/[^\d+ ]/g, "")
            );
            if (!regex.test($(this).val())) {
                event.preventDefault();
                return false;
            }
        });
    </script>
@endsection
