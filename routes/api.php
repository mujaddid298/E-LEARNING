<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\MaterialController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::middleware(['auth:sanctum', 'role:dosen'])
//     ->post('/courses', [CourseController::class, 'store']);

// Route::middleware(['auth:sanctum', 'role:mahasiswa'])
//     ->get('/courses', [CourseController::class, 'index']);




Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'role:lecturer'])->group(function () {

    Route::get('/courses', [CourseController::class, 'index']);
    Route::post('/courses', [CourseController::class, 'store']);
    Route::put('/courses/{id}', [CourseController::class, 'update']);
    Route::delete('/courses/{id}', [CourseController::class, 'destroy']);


    Route::post('/materials',[MaterialController::class, 'store']);
    Route::get('/materials/{id}/download',[MaterialController::class, 'download']);

});



Route::middleware(['auth:sanctum', 'role:student'])->group(function () {

    Route::post('/courses/{id}/enroll', [CourseController::class, 'enroll']);
});
