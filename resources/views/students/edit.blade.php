@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Student Name -->
                    <div class="col-6 form-group">
                        <label for="first_name" class="form-control-label font-weight-bold">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter first name" value="{{ $student->first_name }}" required>
                    </div>

                    <div class="col-6 form-group">
                        <label for="middle_name" class="form-control-label font-weight-bold">Middle Name (Optional)</label>
                        <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Enter middle name" value="{{ $student->middle_name }}">
                    </div>

                    <div class="col-6 form-group">
                        <label for="last_name" class="form-control-label font-weight-bold">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter last name" value="{{ $student->last_name }}" required>
                    </div>

                    <!-- Email Address -->
                    <div class="col-6 form-group">
                        <label for="email" class="form-control-label font-weight-bold">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email address" value="{{ $student->email }}" required>
                    </div>

                    <!-- City -->
                    <div class="col-6 form-group">
                        <label for="city" class="form-control-label font-weight-bold">City</label>
                        <input type="text" name="city" id="city" class="form-control" placeholder="Enter city" value="{{ $student->city }}" required>
                    </div>

                    <!-- State -->
                    <div class="col-6 form-group">
                        <label for="state" class="form-control-label font-weight-bold">State/Province</label>
                        <input type="text" name="state" id="state" class="form-control" placeholder="Enter state or province" value="{{ $student->state }}" required>
                    </div>

                    <!-- Country -->
                    <div class="col-6 form-group">
                        <label for="country" class="form-control-label font-weight-bold">Country</label>
                        <input type="text" name="country" id="country" class="form-control" placeholder="Enter country" value="{{ $student->country }}" required>
                    </div>

                    <!-- Pincode -->
                    <div class="col-6 form-group">
                        <label for="pincode" class="form-control-label font-weight-bold">Pincode</label>
                        <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Enter pincode" value="{{ $student->pincode }}" required>
                    </div>

                    <!-- Phone Number -->
                    <div class="col-6 form-group">
                        <label for="phone" class="form-control-label font-weight-bold">Phone Number</label>
                        <input type="tel" name="phone" id="phone" class="form-control" placeholder="Enter phone number" value="{{ $student->phone }}" required>
                    </div>

                    <!-- Guardian Details -->
                    <div class="col-6 form-group">
                        <label for="guardian_name" class="form-control-label font-weight-bold">Guardian Name</label>
                        <input type="text" name="guardian_name" id="guardian_name" class="form-control" placeholder="Enter guardian's name" value="{{ $student->guardian_name }}" required>
                    </div>

                    <div class="col-6 form-group">
                        <label for="guardian_phone" class="form-control-label font-weight-bold">Guardian Phone Number</label>
                        <input type="tel" name="guardian_phone" id="guardian_phone" class="form-control" placeholder="Enter guardian's phone number" value="{{ $student->guardian_phone }}" required>
                    </div>

                    <!-- Date of Birth -->
                    <div class="col-6 form-group">
                        <label for="dob" class="form-control-label font-weight-bold">Date of Birth</label>
                        <input type="date" name="dob" id="dob" class="form-control" value="{{ $student->dob }}" required>
                    </div>

                    <!-- Gender -->
                    <div class="col-6 form-group">
                        <label for="gender" class="form-control-label font-weight-bold">Gender</label>
                        <select name="gender" id="gender" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ $student->gender == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>


                    <div class="col-6 form-group">
                        <label for="address" class="form-control-label font-weight-bold">Address</label>
                        <textarea name="address" id="address" rows="3" class="form-control" placeholder="Enter address" required>{{ $student->address }}</textarea>
                    </div>


                    <div class="col-6 form-group">
                        <label for="education_level" class="form-control-label font-weight-bold">Current Level of Education</label>
                        <select name="education_level" id="education_level" class="form-control" required>
                            <option value="">Select Education Level</option>
                            <option value="High School" {{ $student->education_level == 'High School' ? 'selected' : '' }}>High School</option>
                            <option value="Undergraduate" {{ $student->education_level == 'Undergraduate' ? 'selected' : '' }}>Undergraduate</option>
                            <option value="Graduate" {{ $student->education_level == 'Graduate' ? 'selected' : '' }}>Graduate</option>
                            <option value="Postgraduate" {{ $student->education_level == 'Postgraduate' ? 'selected' : '' }}>Postgraduate</option>
                        </select>
                    </div>

                    <div class="col-6 form-group">
                        <label for="subjects" class="form-control-label font-weight-bold">Subjects Interested In</label>
                        <select name="subjects[]" id="subjects" class="form-control searchable_dropdown_box" multiple="multiple">
                            @foreach (['Mathematics', 'Science', 'History', 'English', 'Art', 'Music', 'Computer Science'] as $subject)
                                <option value="{{ $subject }}" 
                                    {{ in_array($subject, $selectedSubjects) ? 'selected' : '' }}>
                                    {{ $subject }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-6 form-group">
                        <label for="school_name" class="form-control-label font-weight-bold">School Name</label>
                        <input type="text" name="school_name" id="school_name" class="form-control" value="{{ $student->school_name }}" required>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <div class="choose-file">
                                <label for="achievements">
                                    <div>{{ __('Achievements') }}</div>
                                    <input 
                                        class="form-control" 
                                        name="achievements[]" 
                                        type="file" 
                                        id="achievements" 
                                        accept=".jpg, .jpeg, .png, .pdf, .doc, .docx" 
                                        data-filename="profile_update" 
                                        multiple value="{{ old('achievements[]') }}" required>
                                </label>
                                <p class="achievements"></p>
                            </div>
                            @error('achievements')
                            <span class="invalid-feedback text-danger text-xs" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div id="file-names" class="mt-5">
                            @if($student->achievements && count(json_decode($student->achievements)) > 0)
                                <ul>
                                    @foreach(json_decode($student->achievements) as $file)
                                        <li>{{ basename($file) }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <span class="clearfix"></span>
                        <span class="text-xs text-muted">{{ __('Please upload valid files. Only JPG, PNG, PDF, DOC, and DOCX are allowed. Each file must not exceed 5MB.') }}</span>                  
                    </div>
    

                    <div class="col-6 form-group">
                        <label for="resources" class="form-control-label font-weight-bold">Resources Available</label>
                        <input type="text" name="resources" id="resources" class="form-control" value="{{ $student->resources }}" required>
                    </div>

                    <div class="col-6 form-group">
                        <label for="skills" class="form-control-label font-weight-bold">Skills</label>
                        <textarea name="skills" id="skills" rows="3" class="form-control" required>{{ $student->skills }}</textarea>
                    </div>

                    <div class="col-6 form-group">
                        <label for="interests" class="form-control-label font-weight-bold">Interests</label>
                        <textarea name="interests" id="interests" rows="3" class="form-control" required>{{ $student->interests }}</textarea>
                    </div>

                    <div class="form-group col-12 text-right mt-4">
                        <button type="submit" class="btn btn-primary">Update Student</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
