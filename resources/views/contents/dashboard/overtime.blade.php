@extends('layouts.app')

<div class="container mt-5">
    <div class="overtimecard p-3 card shadow">
        <h3 style="color: #27af59">Over Time</h3>

        <hr class="m-0 mb-3" style="color: gray">

        <div class="overtime-row row">
            <div class="col-6">
                <form action="{{ route ('sign-in') }} " method="POST">
                    @csrf
                
                <div class="employeeid">     
                    <h4>I.D</h4>    
                        <div class="form-floating">
                            <textarea type="email" class="form-control" id="employeeId" style="resize: none; placeholder="name@example.com" disabled>{{ auth()->user()->id }}</textarea>
                            <label for="employeeId">Employee ID</label>
                        </div>
                </div>

                <div class="employeename">
                    <h4>Employee name</h4>
                        <div class="form-floating m-2">
                            <textarea class="form-control" placeholder="Leave a comment here" style="resize: none;" id="employeeName" disabled>{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</textarea>
                            <label for="employeeName">Employee Name:</label>
                        </div>
                </div>

                <div class="department">
                    <h4>Department</h4>
                        <div class="form-floating m-2">
                             <textarea class="form-control" placeholder="Leave a comment here" style="resize: none;" id="department"></textarea>
                            <label for="floatingTextarea2">Your Department:</label>
                        </div>
                </div>

                <div class="reason">
                    <h4>Reason</h4>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" style="resize: none;" id="floatingTextarea2"></textarea>
                            <label for="floatingTextarea2">Reason:</label>
                        </div>
                </div>
            
            
            </div>
        </div>



    </div>
</div>
