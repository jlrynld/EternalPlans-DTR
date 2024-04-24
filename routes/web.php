<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\SignOutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\SampleController;
use Illuminate\Http\Requests;

Route::get('', [SignInController::class, 'index'])->name('signup');

Route::middleware('guest')->group(function () {
    Route::get('/sign-up', [SignUpController::class, 'index'])->name('sign-up.index');
    Route::post('/sign-up-post', [SignUpController::class, 'signUp'])->name('sign-up');

    Route::get('/sign-in', [SignInController::class, 'index'])->name('sign-in.index');
    Route::post('/sign-in-post', [SignInController::class, 'signIn'])->name('sign-in');
});

Route::middleware('auth')->group(function () {
    Route::post('/sign-out', [SignOutController::class, 'signOut'])->name('sign-out');

    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/home-store', [DashboardController::class, 'recordTime'])->name('dashboard.recordTime');
    Route::post('/undertime-checker', [DashboardController::class, 'undertimeRecord'])->name('dashboard.undertimeRecord');

    Route::get('/overtime', [OvertimeController::class, 'index'])->name('dashboard.overtime');
    Route::post('/overtime', [OvertimeController::class, 'index'])->name('dashboard.overtime');

    Route::get('/get-current-time', [DashboardController::class, 'getCurrentTime']);

});

?>
