@extends('layouts.app')

@section('title', 'Eternal Plans, Inc.')

<div class="container mt-5">
    <div class="overtimecard p-3 card shadow">
        <h3 style="color: #27af59">Over Time</h3>

        <hr class="m-0 mb-3" style="color: gray">

        <div class="overtime-row row">
            <div class="col-6">
                <form action="{{ route ('sign-in') }} " method="POST">
                @csrf
                
                <div class="otcalendar m-3" onload="initClock">
                    <div class="otdate">
                        <span id="dayname">{{ now()->format('l')}}</span>,
                        <span id="month">{{ now()->format('M')}}</span>
                        <span id="daynum">{{ now()->format('d')}}</span>,
                        <span id="year">{{ now()->format('Y')}}</span>
                    </div>
                </div>
                
                <div class="ot-date row">
                    <div class="col-md-5 gap-1">
                        <label for="dateforot">Date Of Over Time:</label>
                        <input class="form-control" type="date" id="dateforot" name="dateforot">
                    </div>
                </div>

                <div class="ot-time row">
                    <div class="col-md-4 gap-1">
                        <label for="from-time">From Time:</label>
                        <input class="form-control" type="time" id="from-time" name="from-time">
                    </div>
                
                    <div class="col-md-4 gap-1">
                        <label for="to-time">To Time:</label>
                        <input class="form-control" type="time" id="to-time" name="to-time">
                    </div>

                <div class="nature-work row">
                    <div class="col-12">
                        <label for="nature-work">Nature Of Work</label>
                        <textarea type="text" class="form-control" id="nature-work"></textarea>
                       
                    </div>
                </div>

            </div>
        </div>



    </div>
</div>
