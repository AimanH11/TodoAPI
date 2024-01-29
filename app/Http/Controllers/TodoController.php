<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    /**
     * Display a listing of the Todo items.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $todos = Todo::all();
        Log::info($todos);
        return response()->json($todos);
    }

    /**
     * Store a newly created Todo item.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $todo = Todo::create($validatedData);

        return response()->json($todo);
    }

    /**
     * Update the specified Todo item.
     *
     * @param Request $request
     * @param Todo $todo
     * @return JsonResponse
     */
    public function update(Request $request, Todo $todo): JsonResponse
    {
        $validatedData = $request->validate([
            'completed' => 'required|boolean',
        ]);

        $todo->completed = $validatedData['completed'];
        $todo->save();

        return response()->json($todo);
    }
    /**
     * Display the specified Todo item.
     *
     * @param Todo $todo
     * @return JsonResponse
     */
    public function show(Todo $todo): JsonResponse
    {
        return response()->json($todo);
    }

    /**
     * Remove the specified Todo item.
     *
     * @param Todo $todo
     * @return JsonResponse
     */
    public function destroy(Todo $todo): JsonResponse
    {
        $todo->delete();

        return response()->json(['message' => 'Todo item deleted successfully']);
    }
}
