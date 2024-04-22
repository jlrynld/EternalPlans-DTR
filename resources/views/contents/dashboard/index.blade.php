@extends('layouts.app')

@section('title', 'Eternal Plans, Inc.')

@section('contents')

    <div class="container mt-5">
        <div class="dtrcard p-3 card shadow">
            <h3 style="color: #27af59">
                Daily Time Record

                {{-- ===== Back Button ===== --}}
                {{-- <a class="h4" href="{{ route('dashboard') }}" style="float:right;">
                    <i class="far fa-arrow-alt-circle-left"></i>
                        <span style="font-family: 'Poppins', serif;"> Back </span>
                </a> --}}

            </h3>

            <hr class="m-0 mb-3" style="color: gray">

            {{--==============Clock-and-date================--}}
            <div class="datetime m-3" onload="initClock">
                <div class="date">
                    <span id="dayname">{{ now()->format('l')}}</span>,
                    <span id="month">{{ now()->format('M')}}</span>
                    <span id="daynum">{{ now()->format('d')}}</span>,
                    <span id="year">{{ now()->format('Y')}}</span>
                </div>

                <div class="time">
                    <span id="hour">{{ now()->format('h') }}</span>:
                    <span id="minutes">{{ now()->format('i')}}</span>:
                    <span id="seconds">{{ now()->format('s')}}</span>
                    &nbsp;
                    <span id="period">{{ now()->format('A')}}</span>
                </div>
            </div>
            {{-- ====================================== --}}

            <form action="{{ route('dashboard.recordTime') }}" method="POST" id="dtrForm">
                @csrf
                <div class="dropdown d-flex justify-content-center mb-3">
                    <select name="type" class="form-select form-select-lg w-50" aria-label=".form-select-lg example" id="selectAction">
                        <option value="time_in">Time in</option>
                        <option value="lunch_out">Lunch out</option>
                        <option value="lunch_in">Lunch in</option>
                        <option value="time_out">Time out</option>
                    </select>
               </div>

            {{-- ======================Profile======================== --}}
            <div class="profile-row row" style="width: 50%">
                <div class="col-6">
                    <img src="css/logo/Defaultpic.png" class="img-fluid"alt="Default Profile Pic">
                </div>

                <div class="col-6">
                    <div class="input-group m-2" style="width: 94%">
                        <span class="input-group-text">#</span>
                        <div class="form-floating">
                            <textarea type="email" class="form-control" id="employeeId" style="resize: none; placeholder="name@example.com" disabled>{{ auth()->user()->id }}</textarea>
                            <label for="employeeId">Employee ID</label>
                        </div>
                    </div>

                    <div class="form-floating m-2">
                        <textarea class="form-control" placeholder="Leave a comment here" style="resize: none; id="employeeName" disabled>{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</textarea>
                        <label for="employeeName">Employee Name:</label>
                    </div>
                </div>
            </div>
            {{-- ================================================== --}}

            <div class="container">
                    <input type="hidden" name="current_time" id="currentTime" value="">
                    <div class="dropdown d-flex justify-content-center mb-3">
                        <button style="width: 50%" class="btn btn-success mb-3 mt-3" id="submitButton" type="button">Submit</button>
                    </div>
            </div>
        </form>
            @include('components.form_errors')
        </div>
    </div>

@endsection

@section('scripts')
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

        @elseif (session('timelunchoutChecker'))
            Swal.fire({
                title: "Error! <br> Please time in first!",
                text: "{{ session('lunchinChecker') }}",
                icon: "error"
            });

        @elseif (session('timeinChecker'))
            Swal.fire({
                title: "Error! <br> You have already timed in",
                text: "{{ session('lunchinChecker') }}",
                icon: "warning"
            });

        @elseif (session('lunchoutChecker'))
            Swal.fire({
                title: "Error! <br> You have not lunch out yet!",
                text: "{{ session('lunchinChecker') }}",
                icon: "warning"
            });

        @elseif (session('halfdayChecker'))
            Swal.fire({
                title: "Are you sure you want to time out?",
                html: "<div style='text-align: center;'> {{ session('halfdayChecker') }} </div>",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Gora mo mamsh"
            }).then((result) => {
                    if (result.isConfirmed) {
                    Swal.fire({
                        title: "Submitted!",
                        text: "{{ session('success') }}",
                        icon: "success"
                    });
            }
            });
    @endif
    </script>
@endsection
