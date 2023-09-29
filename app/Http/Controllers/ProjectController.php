<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // Current user
         $user = Auth::user();
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        // Get all projects
        $projects = $user->projects;

        return response()->json([
            'success' => true,
            'data' => $projects
        ], 200);

    }

    public function store(Request $request)
{
    // Validación de datos (puedes personalizar esto según tus necesidades)
    $validatedData = Validator::make($request->all(), [
        'title' => 'required|max:255',
        'description' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
    ]);

    if ($validatedData->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Please fill in all required fields.',
            'errors' => $validatedData->errors()
        ], 400);
    }


    // Obtén el usuario autenticado
    $user = Auth::user();
    if (!$user) {
        return response()->json([
            'message' => 'User not found'
        ], 404);
    }

    // Crea el proyecto asociado al usuario
    $project = new Project([
        'title' => $request->title,
        'description' => $request->description,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'user_id' => $user->id
    ]);


    $project->save();

    return response()->json([
        'success' => true,
        'data' => $project,
        'message' => 'Project created successfully.'
    ], 201); // Código 201 significa "Created"
}


public function show(string $id)
{
    $user = Auth::user();

    // Find the project and check if it belongs to the current user
    $project = Project::where('id', $id)
        ->where('user_id', $user->id)
        ->first();

    if (!$project) {
        return response()->json([
            'message' => 'Project not found'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $project
    ], 200);
}

public function update(Request $request, string $id)
{
    $user = Auth::user();

    $project = Project::where('id', $id)
        ->where('user_id', $user->id)
        ->first();

    if (!$project) {
        return response()->json([
            'message' => 'Project not found'
        ], 404);
    }

    $validatedData = Validator::make($request->all(), [
        'title' => 'required|max:255',
        'description' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
    ]);

    if ($validatedData->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Please fill in all required fields.',
            'errors' => $validatedData->errors()
        ], 400);
    }

    $project->fill($validatedData->validated());
    $project->save();

    return response()->json([
        'success' => true,
        'data' => $project,
        'message' => 'Project updated successfully.'
    ], 200);
}


public function destroy(string $id)
{
    //Get the authenticated user
    $user = Auth::user();

    // Find the project and check if it belongs to the current user
    $project = Project::where('id', $id)
        ->where('user_id', $user->id)
        ->first();

    if (!$project) {
        return response()->json([
            'message' => 'Project not found'
        ], 404);
    }

    // Delete the project
    $project->delete();

    return response()->json([
        'success' => true,
        'message' => 'Project deleted successfully.'
    ], 204);
}



}
