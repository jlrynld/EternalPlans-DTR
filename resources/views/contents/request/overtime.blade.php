@extends('layouts.app')

@section('title', 'Eternal Plans, Inc.')

@section('contents')

    <div class="container mt-5">
        <div class="dtrcard p-3 card shadow">
            <h3 style="color: #27af59">
                Over Time
                <span class="otcalendar" onload="initClock">
                    <span id="dayname">{{ now()->format('l')}}</span>,
                    <span id="month">{{ now()->format('M')}}</span>
                    <span id="daynum">{{ now()->format('d')}}</span>,
                    <span id="year">{{ now()->format('Y')}}</span>
                </span>
            </h3>

            <hr class="m-0 mb-3" style="color: gray">

            <div class="row mb-2">
                <div class="container">
                <div class="ot-row row">
                    <div class="col-3"></div>
                        <div class="col-6">
                            <form action="{{ route('overtime.store') }}"  method="POST">
                                @csrf

                                <div class="row mb-2">
                                    <div class="col-md-6 gap-1">
                                        <label for="dateforot">Date Of Over Time:</label>
                                        <input class="form-control" type="date" id="date" name="date" value="{{ now()->format('Y-m-d') }}">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-6 gap-1">
                                        <label for="from-time">From Time:</label>
                                        <input class="form-control" type="time" id="from-time" name="from_time">
                                    </div>

                                    <div class="col-md-6 gap-1">
                                        <label for="to-time">To Time:</label>
                                        <input class="form-control" type="time" id="to-time" name="to_time">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-12">
                                        <label for="nature-work">Nature Of Work:</label>
                                        <textarea type="text" class="form-control" style="resize: none" id="nature_of_work" name="nature_of_work"></textarea>
                                        <button style="width: 100%" class="btn btn-success mb-3 mt-3" id="btn-submit" type="submit">Submit</button>
                                    </div>
                                </div>
                                @include('components.form_errors')
                            </form>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

@section('scripts')
    <script>
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
        @endif
    </script>

@endsection
