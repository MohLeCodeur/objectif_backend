<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\ReminderController;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);



Route::apiResource('users', UserController::class);
Route::apiResource('goals', GoalController::class);
Route::apiResource('habits', HabitController::class);
Route::apiResource('reminders', ReminderController::class);
