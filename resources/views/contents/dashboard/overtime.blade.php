@extends('layouts.app')

<div class="container mt-5">
    <div class="overtimecard p-3 card shadow">
        <h3 style="color: #27af59">Over Time</h3>

        <hr class="m-0 mb-3" style="color: gray">

        <div class="overtime-row row">
            <div class="col-6">
                <form action="{{ route ('sign-in') }} " method="POST">
                    @csrf

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>

                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>

            </div>
        </div>





    </div>
</div>
