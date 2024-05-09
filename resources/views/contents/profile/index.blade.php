@extends('layouts.app')

@section('title', 'Eternal Plans, Inc.')

@section('contents')

    <div class="container mt-5">
        <div class="dtrcard p-3 card shadow">
            <h3 style="color: #27af59">Employee Profile</h3>
            <hr class="m-0 mb-3" style="color: gray">
                <form action=" " method="POST" id="dtrForm">
                @csrf
                    <div class="row d-flex justify-items-center mx-auto">

                        <span class="fs-6 fst-italic" style="color: #27af59;">*View only, to edit <a class="fw-bold text-decoration-underline" href="{{ route('profile.update-employee') }}">click here</a></span>

                            <div class="col">
                                {{-- ===== Forms ===== --}}

                                {{-- ===== 1st column ===== --}}

                                <div class="form-floating mb-3 mt-3">
                                    <input disabled type="text" class="form-control" name="firstname" id="firstname" placeholder="firstname" value="{{ auth()->user()->firstname }}">
                                        <label for="firstname">First name</label>
                                </div>

                                <div class="input-group mb-3 mt-3">
                                    <span class="input-group-text">#</span>
                                    <div class="form-floating">
                                        <textarea type="text" class="form-control" id="employeeId" style="resize: none;" placeholder = "name@example.com" disabled>{{ auth()->user()->id }}</textarea>
                                        <label for="employeeId">Employee ID</label>
                                    </div>
                                </div>

                                <div class="form-floating mb-3">
                                    <input disabled type="date" class="form-control" name="birthday" id="birthday" placeholder="birthday" value="{{ old('birthday', auth()->user()->birthday) }}">
                                        <label for="birthday">birthday</label>
                                </div>

                                
                            </div>

                            {{-- ===== 2nd Column ====== --}}

                            <div class="col">

                                <div class="form-floating mb-3 mt-3">
                                    <input disabled type="text" class="form-control" name="middlename" id="middlename" placeholder="middlename" value="{{ auth()->user()->middlename }}" onkeypress="return onlyLettersAndSpaces(event)"onpaste="handlePaste(event)"
                                        onblur="removeExtraSpaces(this)">
                                        <label for="middlename">Middle name</label>
                                </div>
                              
                                <div class="input-group mb-3 mt-3">
                                    <span class="input-group-text">#</span>
                                    <div class="form-floating">
                                        <textarea type="email" class="form-control" id="employeeId" style="resize: none;" placeholder = "name@example.com" disabled>EPIOJT</textarea>
                                        <label for="employeeId">Department Code</label>
                                    </div>
                                </div>

                                <div class="form-floating mb-3">
                                    <input disabled type="email" class="form-control" name="email" id="email" placeholder="email" value="{{ auth()->user()->email }}" disabled onpaste="handlePaste(event)"
                                        onblur="removeExtraSpaces(this)">
                                        <label for="email">Email</label>
                                </div>
                               
                            </div>

                            {{-- ====== 3rd Column ====== --}}

                            <div class="col">

                                <div class="form-floating mb-3 mt-3">
                                    <input disabled type="text" class="form-control" name="lastname" id="lastname" placeholder="lastname" value="{{ auth()->user()->lastname }}"onkeypress="return onlyLettersAndSpaces(event)" onpaste="handlePaste(event)"
                                        onblur="removeExtraSpaces(this)">
                                        <label for="lastname">Last name</label>
                                </div>

                                <div class="form-floating mb-3 mt-3">
                                    <input disabled type="text" class="form-control" name="position" id="position" placeholder="position" value="{{ old('position' , auth()->user()->position) }}" onkeypress="return onlyLettersAndSpaces(event)" onpaste="handlePaste(event)"
                                        onblur="removeExtraSpaces(this)">
                                        <label for="address">Position/Branch</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input disabled type="text" class="form-control" name="contact_num" id="contact_num" placeholder="contact_num" value="{{ old('contact_num' , auth()->user()->contact_num) }}"onkeypress="return onlyNumbers(event)" onpaste="handlePaste(event)"
                                        onblur="removeExtraSpaces(this)">
                                        <label for="contact_num">Contact Number</label>
                                </div>
                            </div>

                            {{-- ===== 2nd row ===== --}}

                            <div class="row">

                                <div class="col">
                                    <div class="form-floating">
                                        <select disabled name="civil_status" class="form-select form-select-lg" aria-label=".form-select-lg example" id="selectAction" value="{{ auth()->user()->civil_status }}">
                                            <option value="" style="display: none"> </option>
                                            <option value="single" {{ old('civil_status') == 'single' ? "selected":"" }}>Single</option>
                                            <option value="married" @if(old('civil_status')== 'married') selected @endif>Married</option>
                                            <option value="widowed" @if(old('civil_status')== 'widowed') selected @endif>Widowed</option>
                                            <option value="divorced" @if(old('civil_status')== 'divorced') selected @endif>Divorced</option>
                                        </select>
                                            <label for="selectAction" class="d-flex justify-content-left">Civil Status</label>
                                    </div>
                                    
                                </div>

                                <div class="col-8">
                                    <div class="form-floating mb-2">
                                        <textarea disabled style="height: 100px; resize: none;" type="text" class="form-control" name="address" id="address" placeholder="address" value="{{ old('address' , auth()->user()->address) }}" onpaste="handlePaste(event)"
                                            onblur="removeExtraSpaces(this)"></textarea>         
                                            <label for="address">Address</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>     
            </div>
        </div>
    </div>
        
            @include('components.form_errors')
        </div>
    </div>

@endsection

{{-- @section('scripts')
    <script src="{{ asset('js/submitForm.js') }}"></script>
    <script>
        setInterval(() => {
            getCurrentTime()
        },1000)
        
        @if (session('success'))
            Swal.fire({
                title: "Submitted!",
                text: "{{ session('success') }}",
                icon: "success"
            });
        @elseif (session('error'))
            Swal.fire({
                title: "{{ session('error') }}",
                icon: "error"
            });
        @elseif (session('warning'))
            Swal.fire({
                title: "{{ session('warning') }}",
                icon: "warning"
            });
        @elseif (session('undertimeChecker'))
            Swal.fire({
                title: "Are you sure you want to time out?",
                html: "<div style='text-align: center;'> You are currently undertime. </div>",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Proceed"
            }).then((result) => {
                    if (result.isConfirmed) {
                        $("#undertime-form").submit();
                    }
            });
        @endif
    </script>
@endsection --}}
