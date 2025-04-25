@extends('layouts.admin')

@section('title')
    {{ __('Add Tutor') }}
@endsection

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow p-4 w-100" style="max-width: 1100px; border-radius: 20px;">
        <h3 class="mb-4 pb-2 border-bottom text-primary fw-bold">{{ __('Tutor Information') }}</h3>

        {!! Form::open(['route' => 'tutors.store', 'method' => 'POST']) !!}
        <div class="row g-4">

            <div class="col-md-4">
                {!! Form::label('name', __('Name'), ['class' => 'form-label fw-semibold']) !!}
                {!! Form::text('name', null, ['class' => 'form-control inputTextBox', 'max' => 50, 'placeholder' => 'Full name']) !!}
                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4">
                {!! Form::label('email', __('Email'), ['class' => 'form-label fw-semibold']) !!}
                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                @error('email')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4">
                {!! Form::label('phone', __('Phone'), ['class' => 'form-label fw-semibold']) !!}
                {!! Form::text('phone', null, ['class' => 'form-control mobileNumber', 'maxlength' => 15, 'placeholder' => 'Phone number']) !!}
                @error('phone')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4">
                {!! Form::label('gender', __('Gender'), ['class' => 'form-label fw-semibold']) !!}
                {!! Form::select('gender', ['Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'], null, ['class' => 'form-control select2']) !!}
                @error('gender')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4">
                {!! Form::label('dob', __('Date of Birth'), ['class' => 'form-label fw-semibold']) !!}
                {!! Form::date('dob', null, ['class' => 'form-control']) !!}
                @error('dob')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4">
                {!! Form::label('city', __('City'), ['class' => 'form-label fw-semibold']) !!}
                {!! Form::text('city', null, ['class' => 'form-control', 'max' => 50, 'placeholder' => 'City']) !!}
                @error('city')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4">
                {!! Form::label('state', __('State'), ['class' => 'form-label fw-semibold']) !!}
                {!! Form::text('state', null, ['class' => 'form-control', 'max' => 20, 'placeholder' => 'State']) !!}
                @error('state')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4">
                {!! Form::label('experience', __('Experience (Years)'), ['class' => 'form-label fw-semibold']) !!}
                {!! Form::number('experience', null, ['class' => 'form-control', 'min' => 2, 'max' => 30, 'placeholder' => 'Experience']) !!}
                @error('experience')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4">
                {!! Form::label('qualification', __('Qualification'), ['class' => 'form-label fw-semibold']) !!}
                {!! Form::text('qualification', null, ['class' => 'form-control', 'max' => 50, 'placeholder' => 'Qualification']) !!}
                @error('qualification')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-12">
                {!! Form::label('subject_specialization', __('Subject Specialization'), ['class' => 'form-label fw-semibold']) !!}
                {!! Form::textarea('subject_specialization', null, ['class' => 'form-control', 'rows' => 3, 'max' => 100, 'placeholder' => 'Subjects separated by commas']) !!}
                @error('subject_specialization')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="country" class="form-label fw-semibold">Country</label>
                <select name="country" id="country" class="form-control select2">
                    {!! \App\Helper\HelperFacades::getCountryDropdown() !!}
                </select>
                @error('country')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4">
                {!! Form::label('hourly_rate', __('Per Class Rate (₹)'), ['class' => 'form-label fw-semibold']) !!}
                {!! Form::number('hourly_rate', null, ['class' => 'form-control', 'step' => '50', 'min' => 200, 'max' => 1000, 'placeholder' => 'Rate per class']) !!}
                @error('hourly_rate')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4">
                {!! Form::label('status', __('Status'), ['class' => 'form-label fw-semibold']) !!}
                {!! Form::select('status', ['Active' => 'Active', 'Inactive' => 'Inactive', 'Pending' => 'Pending'], 'Pending', ['class' => 'form-control select2']) !!}
            </div>

            <div class="col-12 d-flex justify-content-end gap-3 mt-4">
                <button type="submit" class="btn btn-success px-4 py-2 fw-bold">{{ __('Save Tutor') }}</button>
                <a href="{{ route('tutors.index') }}" class="btn btn-outline-secondary px-4 py-2 fw-bold">{{ __('Cancel') }}</a>
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
