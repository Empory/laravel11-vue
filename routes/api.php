
<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});
// Get all tasks
Route::get('/tasks', [TaskController::class, 'index']);

// Create a new task
Route::post('/tasks', [TaskController::class, 'store']);

// Delete a taski

Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

