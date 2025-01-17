<form method="POST" action="{{ route('register') }}">
  @csrf

  <!-- Name Field -->
  <div class="form-group row">
      <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
      <div class="col-md-6">
          <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
      </div>
  </div>

  <!-- Email Field -->
  <div class="form-group row">
      <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
      <div class="col-md-6">
          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
      </div>
  </div>

  <!-- Password Fields -->
  <div class="form-group row">
      <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
      <div class="col-md-6">
          <input id="password" type="password" class="form-control" name="password" required>
      </div>
  </div>

  <div class="form-group row">
      <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
      <div class="col-md-6">
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
      </div>
  </div>

  <!-- Hidden User Type -->
  <input type="hidden" name="user_type" value="{{ $userType }}">

  <!-- Submit Button -->
  <div class="form-group row mb-0">
      <div class="col-md-6 offset-md-4">
          <button type="submit" class="btn btn-primary">
              {{ __('Register') }}
          </button>
      </div>
  </div>
</form>
