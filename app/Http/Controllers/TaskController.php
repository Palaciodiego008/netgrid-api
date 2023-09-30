<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TaskController extends Controller
{

    public function index(string $projectId, Request $request) {
    $tasksQuery = Task::where('project_id', $projectId);

    $filters = [
        'title' => 'like',
        'status' => '=',
    ];


    foreach ($filters as $filter => $operator) {
        if ($request->filled($filter)) {
            $value = $request->input($filter);
            $tasksQuery->where($filter, $operator, $value);
        }
    }

    $filteredTasks = $tasksQuery->get();

    return response()->json([
        'success' => true,
        'data' => $filteredTasks,
    ], 200);
}

    public function store(Request $request, string $projectId)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:pendiente,en_progreso,completada'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error.',
                'errors' => $validator->errors()
            ], 400);
        }

        // Create Task Associated with Project
        $task = new Task([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'project_id' => $projectId,
        ]);

        $task->save();

        return response()->json([
            'success' => true,
            'data' => $task,
            'message' => 'Task created successfully.'
        ], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $projectId, string $taskId)
    {
        // Busca la tarea por ID y verifica que pertenezca al proyecto
        $task = Task::where('id', $taskId)
            ->where('project_id', $projectId)
            ->first();

        if (!$task) {
            return response()->json([
                'message' => 'Task not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $task
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $projectId, string $taskId)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'title' => 'string|max:255',
            'description' => 'string',
            'status' => 'in:pendiente,en_progreso,completada'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error.',
                'errors' => $validator->errors()
            ], 400);
        }

        // Find the task and check if it belongs to the project
        $task = Task::where('id', $taskId)
            ->where('project_id', $projectId)
            ->first();

        if (!$task) {
            return response()->json([
                'message' => 'Task not found.'
            ], 404);
        }

        // apply changes
        $task->fill($validator->validated());
        $task->save();

        return response()->json([
            'success' => true,
            'data' => $task,
            'message' => 'Task updated successfully.'
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $projectId, string $taskId)
    {
        $task = Task::where('id', $taskId)
            ->where('project_id', $projectId)
            ->first();

        if (!$task) {
            return response()->json([
                'message' => 'Task not found.'
            ], 404);
        }


        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully.'
        ], 204);
    }

}
