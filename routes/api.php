<?php

use App\Http\Controllers\Api\AssignmentContoller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\DiscussionController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\SubmissionController;
use Illuminate\Support\Facades\Broadcast;

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


    Route::post('/materials', [MaterialController::class, 'store']);
    Route::get('/materials/{id}/download', [MaterialController::class, 'download']);


    Route::post('/assigments', [AssignmentContoller::class, 'store']);

    Route::post('/submissions/{id}/grade', [SubmissionController::class, 'grade']);

    Route::get('/reports/courses', [ReportController::class, 'courses']);
    Route::get('/reports/assignments', [ReportController::class, 'assignments']);
    Route::get('/reports/students/{id}', [ReportController::class, 'student']);
});



Route::middleware(['auth:sanctum', 'role:student'])->group(function () {

    Route::post('/courses/{id}/enroll', [CourseController::class, 'enroll']);

    Route::post('/submissions', [SubmissionController::class, 'store']);
});



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/discussions', [DiscussionController::class, 'store']);
    Route::post('/discussions/{id}/replies', [DiscussionController::class, 'replies']);
});

Broadcast::routes();
