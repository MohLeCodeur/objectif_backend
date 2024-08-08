<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\ReminderController;


Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::put('/', [UserController::class, 'update']);
    Route::delete('/', [UserController::class, 'destroy']);
});
Route::apiResource('users', UserController::class);
Route::apiResource('goals', GoalController::class);
Route::apiResource('habits', HabitController::class);
Route::apiResource('reminders', ReminderController::class);
