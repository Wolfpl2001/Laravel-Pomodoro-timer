<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TimerController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [TaskController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::get('/task', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::post('/tasks/upadte/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    ROute::get('/test', function () {
        return view('test');
    });
Route::get('/timers/latest', [TimerController::class, 'getLatestTimers'])->middleware('auth');
Route::post('/timers', [TimerController::class, 'store']);
Route::put('/timers/{timer}', [TimerController::class, 'update']);
});
Route::put('/save-checkbox/{id}', [TaskController::class, 'saveCheckbox'])->name('save.checkbox');
require __DIR__.'/auth.php';
