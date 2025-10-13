<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                "project_id" => "nullable",
                "name" => "required|string|min:4",
                "description" => "required|string|min:4",
                "status" => "required|string",
                "deadline" => "required"
            ]);
            $task = Task::create($data);
            return response()->json([
                'message' => 'tâche créé avec succès',
                'data' => $task
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erreur lors de la création' . $th->getMessage(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $task = Task::findOrFail($id);
            return response()->json([
                'data' => $task

            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "tâche non trouvé",
                $th->getMessage(),
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         try {
            $data = $request->validate([
                "project_id" => "nullable",
                "name" => "required|string|min:4",
                "description" => "required|string|min:4",
                "status" => "required|string",
                "deadline" => "required"
            ]);

            $task  = Task::findOrFail($id)->update($data);
            return response()->json([
                'message' => 'tâche modifié avec succès',
                'data' => $task
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erreur lors de la modification' . $th->getMessage(),
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         try {
            Task::findOrFail($id)->delete();
            return response()->json([
                'message' => 'tâche supprimé  avec succès',

            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erreur lors de la suppression' . $th->getMessage(),
            ], 400);
        }

    }
}
