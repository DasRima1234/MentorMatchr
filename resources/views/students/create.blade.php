@extends('layouts.admin')

@section('title')
    {{ __('Add Student') }}
@endsection

@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow p-4 w-100" style="max-width: 1100px; border-radius: 20px;">
            <h3 class="mb-4 pb-2 border-bottom text-primary fw-bold">{{ __('Student Information') }}</h3>

            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">First Name</label>
                        <input type="text" name="first_name" class="form-control inputTextBox"
                            placeholder="Enter first name" value="{{ old('first_name') }}">
                        @error('first_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Middle Name (Optional)</label>
                        <input type="text" name="middle_name" class="form-control inputTextBox"
                            placeholder="Enter middle name" value="{{ old('middle_name') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Last Name</label>
                        <input type="text" name="last_name" class="form-control inputTextBox"
                            placeholder="Enter last name" value="{{ old('last_name') }}">
                        @error('last_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email address"
                            value="{{ old('email') }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Phone Number</label>
                        <input type="text" name="phone" class="form-control mobileNumber"
                            placeholder="Enter phone number" value="{{ old('phone') }}">
                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Date of Birth</label>
                        <input type="date" name="dob" class="form-control" value="{{ old('dob') }}">
                        @error('dob')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Gender</label>
                        <select name="gender" class="form-control select2">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                        @error('gender')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">City</label>
                        <input type="text" name="city" class="form-control inputTextBox" placeholder="Enter city"
                            value="{{ old('city') }}">
                        @error('city')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('state', __('State'), ['class' => 'form-label fw-semibold']) !!}
                        {!! Form::text('state', null, ['class' => 'form-control', 'max' => 50, 'placeholder' => 'State']) !!}
                        @error('state')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Country</label>
                        <select name="country" class="form-control select2">
                            {!! \App\Helper\HelperFacades::getCountryDropdown() !!}
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Pincode</label>
                        <input type="text" name="pincode" class="form-control" placeholder="Enter pincode"
                            value="{{ old('pincode') }}">
                        @error('pincode')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Guardian Name</label>
                        <input type="text" name="guardian_name" class="form-control inputTextBox"
                            placeholder="Enter guardian name" value="{{ old('guardian_name') }}">
                        @error('guardian_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Guardian Phone</label>
                        <input type="text" name="guardian_phone" class="form-control mobileNumber"
                            placeholder="Enter guardian phone" value="{{ old('guardian_phone') }}">
                        @error('guardian_phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Current Education Level</label>
                        <select name="education_level" class="form-control select2">
                            <option value="">Select Level</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="Class {{ $i }}">Class {{ $i }}</option>
                            @endfor
                            <option value="High School">High School</option>
                            <option value="Undergraduate">Undergraduate</option>
                            <option value="Graduate">Graduate</option>
                            <option value="Postgraduate">Postgraduate</option>
                        </select>
                        @error('education_level')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <label class="form-label fw-semibold">School Name</label>
                        <input type="text" name="school_name" class="form-control inputTextBox"
                            placeholder="Enter school name" value="{{ old('school_name') }}">
                        @error('school_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 d-flex justify-content-end gap-3 mt-4">
                        <button type="submit"
                            class="btn btn-success px-4 py-2 fw-bold">{{ __('Register Student') }}</button>
                        <a href="{{ route('students.index') }}"
                            class="btn btn-outline-secondary px-4 py-2 fw-bold">{{ __('Cancel') }}</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        $(".inputTextBox").on("keypress keyup blur change", function(event) {
            var regex = new RegExp("^[a-zA-Z ]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            $(this).val($(this).val().replace(/[^a-zA-Z \.]/g, ""));
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });

        $(".mobileNumber").on("keypress keyup blur change", function(event) {
            var regex = /^[\\d+ ]*$/;
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            $(this).val($(this).val().replace(/[^\\d+ ]/g, ""));
            if (!regex.test($(this).val())) {
                event.preventDefault();
                return false;
            }
        });

        $('input[name="city"]').blur(function() {
            let city = $(this).val().trim();
            let country = $('select[name="country"]').val();
            let stateInput = $('input[name="state"]'); // Now it's an input box

            if (city && country) {
                $.ajax({
                    url: `https://nominatim.openstreetmap.org/search?city=${city}&country=${country}&format=json&limit=1`,
                    type: "GET",
                    success: function(response) {
                        if (response.length > 0) {
                            let displayName = response[0].display_name.split(", ");
                            let state = displayName.length > 1 ? displayName[1] : "";
                            stateInput.val(state); // Fill the input box
                        } else {
                            stateInput.val("State not found");
                        }
                    },
                    error: function() {
                        console.log("Error fetching state data");
                        stateInput.val("Error fetching state");
                    }
                });
            }
        });
    </script>
@endsection
