@extends('layouts.auth')

@section('contents')
    <div class="container" style="max-width: 600px;">
        <div class="mt-5">
            <form action="{{ route('sign-up') }}" method="POST">
                @csrf
                @method("POST")

                @include('components.form_errors')

                <h3 class="mb-4 mx-auto text-center">
                    Register
                </h3>

                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                    </div>
                @endif

                <div class="form-floating mb-3">
                    <select name="type" class="form-control" id="type" required>
                        <option value="Employee" {{ old('type') == 'Employee' ? "selected":"" }}>Employee</option>
                        <option value="Manager" @if(old('type')== 'Manager') selected @endif >Manager</option>
                    </select>
                    <label for="type">User Type <span class="text-danger">*</span></label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="firstname" value="{{ old('firstname') }}"onkeypress="return onlyLettersAndSpaces(event)"onpaste="handlePaste(event)"
                    onblur="removeExtraSpaces(this)">
                        <label for="firstname">First name</label>
                </div>


                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="lastname" value="{{ old('lastname') }}"onkeypress="return onlyLettersAndSpaces(event)" onpaste="handlePaste(event)"
                    onblur="removeExtraSpaces(this)">
                        <label for="lastname">Last name</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email" id="email" placeholder="email" value="{{ old('email') }}"onpaste="handlePaste(event)"
                    onblur="removeExtraSpaces(this)">
                        <label for="email">Email</label>
                </div>


                <div class="form-floating mb-3" id="show_hide_password">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        <label for="password">Password</label>
                    <span id="showEye">
                        <i class='bx bxs-hide' id="eye" onclick="showPassword(pass, eye)"></i>
                    </span>
                </div>


                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password_confirmation" id="password-confirmation" placeholder="Confirm Password" required>
                        <label for="password-confirmation">Confirm Password <span class="text-danger">*</span></label>
                    <span id="showEye">
                        <i class='bx bxs-hide' id="eye1" onclick="showPassword(pass1, eye1)"></i>
                    </span>
                </div>


                <div class="text-center">
                      <input style="width: 100%" type="submit" value="Register account" class="btn btn-success mb-3 mt-2">
                </div>
                <div class="text-center pb-5">
                    Already have an account? <a href="{{ route('sign-in.index') }}">Sign-in</a>
                </div>
            </form>
        </div>
    </div>
@endsection
