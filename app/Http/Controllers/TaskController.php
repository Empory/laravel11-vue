<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        try {
            return Task::all();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch tasks'], 500);
        }
    }
    
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        try {
            // Create a new task
            $task = Task::create($validated);
            return response()->json($task, 201);
        } catch (\Exception $e) {
            // Log the error and return a response
            \Log::error('Failed to create task', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to create task'], 500);
        }
    }
    

    public function destroy($id)
    {
        try {
            Task::destroy($id);
            return response()->noContent();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete task'], 500);
        }
    }
    
}
