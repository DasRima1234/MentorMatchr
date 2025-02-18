@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf <div class="row">
                    <!-- Student Name -->
                    <div class="col-6 form-group">
                        <label for="first_name" class="form-control-label font-weight-bold">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control"
                            placeholder="Enter first name" value="{{ old('first_name') }}" required>
                    </div>

                    <div class="col-6 form-group">
                        <label for="middle_name" class="form-control-label font-weight-bold">Middle Name (Optional)</label>
                        <input type="text" name="middle_name" id="middle_name" class="form-control"
                            placeholder="Enter middle name" value="{{ old('middle_name') }}">
                    </div>

                    <div class="col-6 form-group">
                        <label for="last_name" class="form-control-label font-weight-bold">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control"
                            placeholder="Enter last name" value="{{ old('last_name') }}" required>
                    </div>


                    <!-- Email Address -->
                    <div class="col-6 form-group">
                        <label for="email" class="form-control-label font-weight-bold">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="Enter email address" value="{{ old('email') }}" required>
                    </div>
                    <div class="col-6 form-group">
                        <label for="city" class="form-control-label font-weight-bold">City</label>
                        <input type="text" name="city" id="city" class="form-control" placeholder="Enter city"
                            value="{{ old('city') }}" required>
                    </div>

                    <!-- State -->

                    <div class="col-6 form-group">
                        <label for="state" class="form-control-label font-weight-bold">State/Province</label>
                        <input type="text" name="state" id="state" class="form-control"
                            placeholder="Enter state or province" value="{{ old('state') }}" required>
                    </div>

                    <!-- Country -->
                    <div class="col-6 form-group">
                        <label for="country" class="form-control-label font-weight-bold">Country</label>
                        <input type="text" name="country" id="country" class="form-control" placeholder="Enter country"
                            value="{{ old('country') }}" required>
                    </div>

                    <!-- Pincode -->
                    <div class="col-6 form-group">
                        <label for="pincode" class="form-control-label font-weight-bold">Pincode</label>
                        <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Enter pincode"
                            value="{{ old('pincode') }}" required>
                    </div>

                    <!-- Phone Number -->
                    <div class="col-6 form-group">
                        <label for="phone" class="form-control-label font-weight-bold">Phone Number</label>
                        <input type="tel" name="phone" id="phone" class="form-control"
                            placeholder="Enter phone number" value="{{ old('phone') }}" required>
                    </div>
                    <div class="col-6 form-group">
                        <label for="guardian_name" class="form-control-label font-weight-bold">Guardian Name</label>
                        <input type="text" name="guardian_name" id="guardian_name" class="form-control"
                            placeholder="Enter guardian's name" value="{{ old('guardian_name') }}" required>
                    </div>

                    <div class="col-6 form-group">
                        <label for="guardian_phone" class="form-control-label font-weight-bold">Guardian Phone
                            Number</label>
                        <input type="tel" name="guardian_phone" id="guardian_phone" class="form-control"
                            placeholder="Enter guardian's phone number" value="{{ old('guardian_phone') }}" required>
                    </div>

                    <!-- Date of Birth -->
                    <div class="col-6 form-group">
                        <label for="dob" class="form-control-label font-weight-bold">Date of Birth</label>
                        <input type="date" name="dob" id="dob" class="form-control"
                            value="{{ old('dob') }}" required>
                    </div>

                    <!-- Gender -->
                    <div class="col-6 form-group">
                        <label for="gender" class="form-control-label font-weight-bold">Gender</label>
                        <select name="gender" id="gender" class="form-control searchable_dropdown_box"
                            value="{{ old('gender') }}" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <!-- Address -->
                    <div class="col-6 form-group">
                        <label for="address" class="form-control-label font-weight-bold">Address</label>
                        <textarea name="address" id="address" rows="3" class="form-control" placeholder="Enter address"
                            value="{{ old('address') }}" required></textarea>
                    </div>

                    <!-- Academic Background -->

                    <div class="col-6 form-group">
                        <label for="education_level" class="form-control-label font-weight-bold">Current Level of
                            Education</label>
                        <select name="education_level" id="education_level" class="form-control searchable_dropdown_box"
                            value="{{ old('education_level') }}" required>
                            <option value="">Select Education Level</option>
                            <option value="High School">High School</option>
                            <option value="Undergraduate">Undergraduate</option>
                            <option value="Graduate">Graduate</option>
                            <option value="Postgraduate">Postgraduate</option>
                        </select>
                    </div>

                    <div class="col-6 form-group">
                        <label for="subjects" class="form-control-label font-weight-bold">Subjects Interested In</label>
                        <select name="subjects[]" id="subjects" class="form-control searchable_dropdown_box" multiple
                            value="{{ old('subjects[]') }}" required>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Science">Science</option>
                            <option value="History">History</option>
                            <option value="English">English</option>
                            <option value="Art">Art</option>
                            <option value="Music">Music</option>
                            <option value="Computer Science">Computer Science</option>
                        </select>
                    </div>

                    <div class="col-6 form-group">
                        <label for="school_name" class="form-control-label font-weight-bold">School Name</label>
                        <input type="text" name="school_name" id="school_name" class="form-control"
                            placeholder="Enter school name" value="{{ old('middle_name') }}" required>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <div class="choose-file">
                                <label for="achievements">
                                    <div>{{ __('Achievements') }}</div>
                                    <input class="form-control" name="achievements[]" type="file" id="achievements"
                                        accept=".jpg, .jpeg, .png, .pdf, .doc, .docx" data-filename="profile_update"
                                        multiple value="{{ old('achievements[]') }}" required>
                                </label>
                                <p class="achievements"></p>
                            </div>
                            @error('achievements')
                                <span class="invalid-feedback text-danger text-xs" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <span class="clearfix"></span>
                        <span
                            class="text-xs text-muted">{{ __('Please upload valid files. Only JPG, PNG, PDF, DOC, and DOCX are allowed. Each file must not exceed 5MB.') }}</span>
                    </div>

                       <!-- Interests -->
                       <div class="col-6 form-group">
                        <label for="interests" class="form-control-label font-weight-bold">Interests</label>
                        <textarea name="interests" id="interests" rows="4" 
                                  class="form-control" maxlength="255" style="width:100%;height:auto;">{{ old('interests') }}</textarea>
                        <p class="text-xs text-muted mt-1">Enter your interests (up to 255 characters).</p>                    
                    </div>
                    <!-- Resources Available -->
                    <!-- Resources -->
                    <div class="col-6 form-group">
                        <label for="resources" class="form-control-label font-weight-bold">Resources Available</label>
                        <div>
                            @foreach (['Transportation', 'Printer', 'Laptop/PC', 'Venue', 'Books'] as $resource)
                                <div class="col-6 custom-control custom-checkbox">
                                    <input type="checkbox" name="resources[]" id="resource_{{ $loop->index }}"
                                        value="{{ $resource }}" class="custom-control-input"
                                        {{ in_array($resource, old('resources', [])) ? 'checked' : '' }}>
                                    <label for="resource_{{ $loop->index }}"
                                        class="custom-control-label">{{ $resource }}</label>
                                </div>
                            @endforeach
                        </div>
                        <p class="text-xs text-muted mt-1">You can select up to 3 resources.</p>
                    </div>

                    <!-- Skills -->
                    <div class="col-6 form-group">
                        <label for="skills" class="form-control-label font-weight-bold">Skills</label>
                        <div>
                            @foreach (['Programming', 'Design', 'Writing', 'Public Speaking', 'Management','Acting','Singing','Dancing','Playing guitar','Photography'] as $skill)
                                <div class="col-6 custom-control custom-checkbox">
                                    <input type="checkbox" name="skills[]" id="skill_{{ $loop->index }}"
                                        value="{{ $skill }}" class="custom-control-input"
                                        {{ in_array($skill, old('skills', [])) ? 'checked' : '' }}>
                                    <label for="skill_{{ $loop->index }}"
                                        class="custom-control-label">{{ $skill }}</label>
                                </div>
                            @endforeach
                        </div>
                        <p class="text-xs text-muted mt-1">You can select up to 3 skills.</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-lg-12 text-right">
                        <button type="submit" class="btn btn-primary">Register Student</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
