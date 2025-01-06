@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('students.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Student Name -->
                    <div class="col-6 form-group">
                        <label for="first_name" class="form-control-label font-weight-bold">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter first name" required>
                    </div>
                    
                    <div class="col-6 form-group">
                        <label for="middle_name" class="form-control-label font-weight-bold">Middle Name (Optional)</label>
                        <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Enter middle name">
                    </div>
                    
                    <div class="col-6 form-group">
                        <label for="last_name" class="form-control-label font-weight-bold">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter last name" required>
                    </div>
                    

                    <!-- Email Address -->
                    <div class="col-6 form-group">
                        <label for="email" class="form-control-label font-weight-bold">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email address" required>
                    </div>
                    <div class="col-6 form-group">
                        <label for="city" class="form-control-label font-weight-bold">City</label>
                        <input type="text" name="city" id="city" class="form-control" placeholder="Enter city" required>
                    </div>

                    <!-- State -->
                    <div class="col-6 form-group">
                        <label for="state" class="form-control-label font-weight-bold">State/Province</label>
                        <input type="text" name="state" id="state" class="form-control" placeholder="Enter state or province" required>
                    </div>

                    <!-- Country -->
                    <div class="col-6 form-group">
                        <label for="country" class="form-control-label font-weight-bold">Country</label>
                        <input type="text" name="country" id="country" class="form-control" placeholder="Enter country" required>
                    </div>

                    <!-- Pincode -->
                    <div class="col-6 form-group">
                        <label for="pincode" class="form-control-label font-weight-bold">Pincode</label>
                        <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Enter pincode" required>
                    </div>

                    <!-- Phone Number -->
                    <div class="col-6 form-group">
                        <label for="phone" class="form-control-label font-weight-bold">Phone Number</label>
                        <input type="tel" name="phone" id="phone" class="form-control" placeholder="Enter phone number" required>
                    </div>
                    <div class="col-6 form-group">
                        <label for="guardian_name" class="form-control-label font-weight-bold">Guardian Name</label>
                        <input type="text" name="guardian_name" id="guardian_name" class="form-control" placeholder="Enter guardian's name" required>
                    </div>

                    <div class="col-6 form-group">
                        <label for="guardian_phone" class="form-control-label font-weight-bold">Guardian Phone Number</label>
                        <input type="tel" name="guardian_phone" id="guardian_phone" class="form-control" placeholder="Enter guardian's phone number" required>
                    </div>

                    <!-- Date of Birth -->
                    <div class="col-6 form-group">
                        <label for="dob" class="form-control-label font-weight-bold">Date of Birth</label>
                        <input type="date" name="dob" id="dob" class="form-control" required>
                    </div>

                    <!-- Gender -->
                    <div class="col-6 form-group">
                        <label for="gender" class="form-control-label font-weight-bold">Gender</label>
                        <select name="gender" id="gender" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <!-- Address -->
                    <div class="col-6 form-group">
                        <label for="address" class="form-control-label font-weight-bold">Address</label>
                        <textarea name="address" id="address" rows="3" class="form-control" placeholder="Enter address" required></textarea>
                    </div>

                    <!-- Academic Background -->

                    <div class="col-6 form-group">
                        <label for="education_level" class="form-control-label font-weight-bold">Current Level of Education</label>
                        <select name="education_level" id="education_level" class="form-control" required>
                            <option value="">Select Education Level</option>
                            <option value="High School">High School</option>
                            <option value="Undergraduate">Undergraduate</option>
                            <option value="Graduate">Graduate</option>
                            <option value="Postgraduate">Postgraduate</option>
                        </select>
                    </div>

                    <div class="col-6 form-group">
                        <label for="subjects" class="form-control-label font-weight-bold">Subjects Interested In</label>
                        <select name="subjects[]" id="subjects" class="form-control" multiple required>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Science">Science</option>
                            <option value="History">History</option>
                            <option value="English">English</option>
                            <option value="Art">Art</option>
                            <option value="Music">Music</option>
                            <option value="Computer Science">Computer Science</option>
                            <!-- Add more subjects as needed -->
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="school_name" class="form-control-label font-weight-bold">School Name</label>
                        <input type="text" name="school_name" id="school_name" class="form-control" placeholder="Enter school name" required>
                    </div>

                    <div class="col-6 form-group">
                        <label for="achievements" class="form-control-label font-weight-bold">Achievements</label>
                        <input type="file" name="achievements[]" id="achievements" class="form-control" multiple>
                    </div>

                    <!-- Resources Available -->
                    <div class="col-6 form-group">
                        <label for="resources" class="form-control-label font-weight-bold">Resources Available</label>
                        <input type="text" name="resources" id="resources" class="form-control" placeholder="Enter available resources" required>
                    </div>

                    <!-- Skills -->
                    <div class="col-6 form-group">
                        <label for="skills" class="form-control-label font-weight-bold">Skills</label>
                        <textarea name="skills" id="skills" rows="3" class="form-control" placeholder="Enter skills" required></textarea>
                    </div>

                    <!-- Interests -->
                    <div class="col-6 form-group">
                        <label for="interests" class="form-control-label font-weight-bold">Interests</label>
                        <textarea name="interests" id="interests" rows="3" class="form-control" placeholder="Enter interests" required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group col-12 text-right mt-4">
                        <button type="submit" class="btn btn-primary">Register Student</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
