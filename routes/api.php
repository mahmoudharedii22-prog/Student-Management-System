<?php

use App\Http\Controllers\Api\Admin\AttendanceController as AdminAttendanceController;
use App\Http\Controllers\Api\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Api\Admin\EnrollmentController;
use App\Http\Controllers\Api\Admin\GradeController;
use App\Http\Controllers\Api\Admin\StudentController;
use App\Http\Controllers\Api\Auth\SessionController;
use App\Http\Controllers\Api\Student\AttendanceController as StudentAttendanceController;
use App\Http\Controllers\Api\Student\CourseController as StudentCourseController;
use App\Http\Controllers\Api\Student\GradeController as StudentGradeController;
use App\Http\Controllers\Api\Student\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::post('/register', [SessionController::class, 'store']);
    Route::post('/login', [SessionController::class, 'login']);
    Route::delete('/logout', [SessionController::class, 'logout'])->middleware('auth:sanctum');

});

Route::middleware(['auth:sanctum', 'isAdmin'])->prefix('v1/admin')->group(function () {
    Route::get('/students', [StudentController::class, 'index']);
    Route::post('/students/store', [StudentController::class, 'store']);
    Route::get('/students/{id}', [StudentController::class, 'show']);
    Route::put('/students/{user}', [StudentController::class, 'update']);
    Route::delete('/students/{user}', [StudentController::class, 'destroy']);
    Route::delete('/students/{user}', [StudentController::class, 'forceDelete']);
    Route::get('/students/deleted', [StudentController::class, 'showDeleted']);
    Route::post('/students/{student}/restore', [StudentController::class, 'restore']);

    Route::get('/courses', [AdminCourseController::class, 'index']);
    Route::post('/courses/store', [AdminCourseController::class, 'store']);
    Route::get('/courses/{id}', [AdminCourseController::class, 'show']);
    Route::put('/courses/{course}', [AdminCourseController::class, 'update']);
    Route::delete('/courses/{course}', [AdminCourseController::class, 'destroy']);
    Route::delete('/courses/{course}', [AdminCourseController::class, 'forceDelete']);
    Route::get('/courses/deleted', [AdminCourseController::class, 'showDeleted']);
    Route::post('/courses/{course}/restore', [AdminCourseController::class, 'restore']);

    Route::get('/grades', [GradeController::class, 'index']);
    Route::post('/grades/store', [GradeController::class, 'store']);
    Route::get('/grades/{id}', [GradeController::class, 'show']);
    Route::put('/grades/{grade}', [GradeController::class, 'update']);
    Route::delete('/grades/{grade}', [GradeController::class, 'destroy']);

    Route::post('/enrollments', [EnrollmentController::class, 'store']);
    Route::delete('/enrollments/{enrollment}', [EnrollmentController::class, 'destroy']);

    Route::post('/attendance', [AdminAttendanceController::class, 'index']);
    Route::get('/students/{id}/attendance', [AdminAttendanceController::class, 'show']);

});

Route::middleware(['auth:sanctum', 'isStudent'])->prefix('v1/students')->group(function () {
    Route::get('/me', [ProfileController::class, 'index']);
    Route::get('/courses', [StudentCourseController::class, 'index']);
    Route::post('/attendance/check-in', [StudentAttendanceController::class, 'store']);
    Route::post('/attendance/check-out', [StudentAttendanceController::class, 'update']);
    Route::get('/attendance', [StudentAttendanceController::class, 'index']);
    Route::get('/grades', [StudentGradeController::class, 'index']);

});
