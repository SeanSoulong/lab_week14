<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\EnsurTokenIsValid;

Route::middleware([EnsurTokenIsValid::class])->group(function () {

    Route::get('/', fn() => view('welcome'));

    // Student Routes
    Route::get('/students', [ClassroomController::class, 'getStudents']);
    Route::post('/students', [ClassroomController::class, 'createStudent']);
    Route::delete('/students/{id}', [ClassroomController::class, 'deleteStudent']);
    Route::patch('/students/{id}', [ClassroomController::class, 'updateStudent']);

    // Teacher Routes
    Route::get('/teachers', [ClassroomController::class, 'getTeachers']);
    Route::post('/teachers', [ClassroomController::class, 'createTeacher']);
    Route::delete('/teachers/{id}', [ClassroomController::class, 'deleteTeacher']);
    Route::patch('/teachers/{id}', [ClassroomController::class, 'updateTeacher']);
});

// Auth Routes (excluded from token middleware)
Route::post('/register', [AuthController::class, 'register'])->withoutMiddleware(EnsurTokenIsValid::class);
Route::post('/login', [AuthController::class, 'login'])->withoutMiddleware(EnsurTokenIsValid::class);
