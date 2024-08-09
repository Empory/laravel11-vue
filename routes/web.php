
<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});
// Get all tasks
Route::middleware('web')->group(function () {
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
});