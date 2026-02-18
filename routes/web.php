<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test/discussion', function () {
    return view('test.discussion');
});

Route::get('/test/replies', action: function () {
    return view('test.replies');
});
