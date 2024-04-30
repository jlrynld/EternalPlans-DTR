@extends('layouts.app')

@section('title', 'Eternal Plans, Inc.')

@section('contents')

    <div class="container mt-5">
        <div class="dtrcard p-3 card shadow">
            <h3 style="color: #27af59">Profile</h3>
            <hr class="m-0 mb-3" style="color: gray">
                <form action="{{ route('profile.update') }}" method="POST" id="dtrForm">
                @csrf
                    <div class="row">
                        <div class="col-6">
                            {{-- ===== Forms ===== --}}

                                <div class="form-floating mb-3 mt-3">
                                    <input type="text" class="form-control" name="employee_code" id="employee_code" placeholder="employee_code" value="{{ auth()->user()->id }}" >
                                        onblur="removeExtraSpaces(this)">
                                        <label for="emloyeecode">Employee ID</label>
                                </div>
                                


                                <div class="form-floating mb-3 mt-3">
                                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="firstname" value="{{ auth()->user()->firstname }}" onkeypress="return onlyLettersAndSpaces(event)"onpaste="handlePaste(event)"
                                        onblur="removeExtraSpaces(this)">
                                        <label for="firstname">First name</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="lastname" value="{{ auth()->user()->lastname }}"onkeypress="return onlyLettersAndSpaces(event)" onpaste="handlePaste(event)"
                                        onblur="removeExtraSpaces(this)">
                                        <label for="lastname">Last name</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="email" value="{{ auth()->user()->email }}"onpaste="handlePaste(event)"
                                        onblur="removeExtraSpaces(this)">
                                        <label for="email">Email</label>
                                </div>

                                
                            {{-- ============ --}}
                        </div>  
                            <div class="col-6">
                                <div class="form-floating mb-3 mt-3">
                                    <input type="text" class="form-control" name="address" id="address" placeholder="address" value="{{ auth()->user()->address }}" onpaste="handlePaste(event)"
                                        onblur="removeExtraSpaces(this)">
                                        <label for="address">Address</label>
                                </div>

                                <div class="form-floating mb-3 mt-3">
                                    <input type="text" class="form-control" name="position" id="position" placeholder="position" value="{{ auth()->user()->position }}" onpaste="handlePaste(event)"
                                        onblur="removeExtraSpaces(this)">
                                        <label for="address">Position</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" name="birthday" id="birthday" placeholder="birthday" value="{{ auth()->user()->birthday }}"onpaste="handlePaste(event)"
                                        onblur="removeExtraSpaces(this)">
                                        <label for="birthday">birthday</label>
                                </div>

                            </div>

                            <div class="col-3"></div>

                            <div class="dropdown d-flex justify-content-center mt-3 w-50">
                                <select name="type" class="form-select form-select-lg " aria-label=".form-select-lg example" id="selectAction" value="{{ auth()->user()->type }}">
                                    <option value="disabled selected">Select Civil Status</option>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="widowed">Widowed</option>
                                    <option value="divorced">Divorced</option>
                                </select>
                           </div>


                            <div class="container">
                                <input type="hidden" name="current_time" id="currentTime" value="">
                                    <div class="dropdown d-flex justify-content-center mb-3">
                                        <button style="width: 25%" class="btn btn-success mb-3 mt-3" id="submitButton" type="button">Submit</button>
                                    </div>
                        </div>
                    </div>
                </form>     
            </div>
        </div>
    </div>
        
        <form method="POST" action="{{ route('dashboard.undertimeRecord')}} " id="undertime-form">
            @csrf
        </form>
        
            @include('components.form_errors')
        </div>
    </div>

@endsection

@section('scripts')
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
@endsection
