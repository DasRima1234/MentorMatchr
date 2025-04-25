@extends('layouts.admin')

@section('title')
    {{ __('Edit Student') }}
@endsection

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow p-4 w-100" style="max-width: 1100px; border-radius: 20px;">
        <h3 class="mb-4 pb-2 border-bottom text-primary fw-bold">{{ __('Student Information') }}</h3>

        <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <div class="col-md-3">
                    <label class="form-label fw-semibold">First Name</label>
                    <input type="text" name="first_name" class="form-control inputTextBox @error('first_name') is-invalid @enderror" placeholder="Enter first name" value="{{ old('first_name', $student->first_name) }}">
                    @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Middle Name (Optional)</label>
                    <input type="text" name="middle_name" class="form-control inputTextBox" placeholder="Enter middle name" value="{{ old('middle_name', $student->middle_name) }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Last Name</label>
                    <input type="text" name="last_name" class="form-control inputTextBox @error('last_name') is-invalid @enderror" placeholder="Enter last name" value="{{ old('last_name', $student->last_name) }}">
                    @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Email Address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email address" value="{{ old('email', $student->email) }}">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Phone Number</label>
                    <input type="text" name="phone" class="form-control mobileNumber @error('phone') is-invalid @enderror" placeholder="Enter phone number" value="{{ old('phone', $student->phone) }}">
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Date of Birth</label>
                    <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob', $student->dob) }}">
                    @error('dob')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Gender</label>
                    <select name="gender" class="form-control select2 @error('gender') is-invalid @enderror">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender', $student->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-3">
                    <label class="form-label fw-semibold">City</label>
                    <input type="text" name="city" class="form-control inputTextBox @error('city') is-invalid @enderror" placeholder="Enter city" value="{{ old('city', $student->city) }}">
                    @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">State</label>
                    <input type="text" name="state" class="form-control inputTextBox @error('state') is-invalid @enderror" placeholder="Enter state" value="{{ old('state', $student->state) }}">
                    @error('state')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="country" class="form-label">Country</label>
                        <select name="country" id="country" class="form-control select2">
                            {!! \App\Helper\HelperFacades::getCountryDropdown($student->country) !!}
                        </select>
                        @error('country')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Pincode</label>
                    <input type="text" name="pincode" class="form-control @error('pincode') is-invalid @enderror" placeholder="Enter pincode" value="{{ old('pincode', $student->pincode) }}">
                    @error('pincode')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Guardian Name</label>
                    <input type="text" name="guardian_name" class="form-control inputTextBox @error('guardian_name') is-invalid @enderror" placeholder="Enter guardian name" value="{{ old('guardian_name', $student->guardian_name) }}">
                    @error('guardian_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Guardian Phone</label>
                    <input type="text" name="guardian_phone" class="form-control mobileNumber @error('guardian_phone') is-invalid @enderror" placeholder="Enter guardian phone" value="{{ old('guardian_phone', $student->guardian_phone) }}">
                    @error('guardian_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Current Education Level</label>
                    <select name="education_level" class="form-control select2 @error('education_level') is-invalid @enderror">
                        <option value="">Select Level</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="Class {{ $i }}" {{ old('education_level', $student->education_level) == "Class $i" ? 'selected' : '' }}>
                                Class {{ $i }}
                            </option>
                        @endfor
                        <option value="High School" {{ old('education_level', $student->education_level) == 'High School' ? 'selected' : '' }}>High School</option>
                        <option value="Undergraduate" {{ old('education_level', $student->education_level) == 'Undergraduate' ? 'selected' : '' }}>Undergraduate</option>
                        <option value="Graduate" {{ old('education_level', $student->education_level) == 'Graduate' ? 'selected' : '' }}>Graduate</option>
                        <option value="Postgraduate" {{ old('education_level', $student->education_level) == 'Postgraduate' ? 'selected' : '' }}>Postgraduate</option>
                    </select>
                    @error('education_level')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-semibold">School Name</label>
                    <input type="text" name="school_name" class="form-control inputTextBox @error('school_name') is-invalid @enderror" placeholder="Enter school name" value="{{ old('school_name', $student->school_name) }}">
                    @error('school_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 d-flex justify-content-end gap-3 mt-4">
                    <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">{{ __('Update Student') }}</button>
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary px-4 py-2 fw-bold">{{ __('Cancel') }}</a>
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

    $('input[name="city"]').blur(function () {
        let city = $(this).val().trim();
        let country = $('select[name="country"]').val();
        let stateInput = $('input[name="state"]'); // Now it's an input box

        if (city && country) {
            $.ajax({
                url: `https://nominatim.openstreetmap.org/search?q=${city},${country}&format=json&limit=1`,
                type: "GET",
                success: function (response) {
                    if (response.length > 0) {
                        let displayName = response[0].display_name.split(", ");
                        let state = displayName.length > 1 ? displayName[displayName.length - 2] : "";
                        stateInput.val(state); // Fill the input box
                    } else {
                        stateInput.val("State not found");
                    }
                },
                error: function () {
                    console.log("Error fetching state data");
                    stateInput.val("Error fetching state");
                }
            });
        }
    });


</script>
@endsection
