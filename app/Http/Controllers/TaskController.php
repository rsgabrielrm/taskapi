<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean',
        ]);

        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $task)
    {
        $task = Task::find($task);
        if (empty($task)) {
            return response()->json('Task not found', 404);
        }

        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'status' => 'sometimes|boolean',
        ]);

        $task->fill($request->only(['title', 'description', 'status']));
        $task->save();
        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $task)
    {
        $task = Task::find($task);
        if (empty($task)) {
            return response()->json('Task not found', 404);
        }
        $task->delete();
        return response()->json('Task deleted successfully!', 204);
    }
}
