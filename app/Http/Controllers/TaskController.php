<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $task = Auth::user()->tasks()->get();
        return view('tasks.index', compact('task'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'completed' => 'required|in:yes,no',
            'user_id' => $request->user_id,
        ]);

        $task = Auth::user()->tasks()->create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'completed' => $request->get('completed'),
            'user_id' => $request->get('user_id'),
        ]);
        return redirect('/tasks')->with('success', 'Task created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Auth::user()->tasks()->findOrFail($id);
        if(!$task) {
            return redirect('tasks.index')->with('error', 'Task not found');
        }
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Auth::user()->tasks()->findOrFail($id);
        if(!$task) {
            return redirect('tasks.index')->with('error', 'Task not found');
        }
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Auth::user()->tasks()->findOrFail($id);
       $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'completed' => 'required|in:yes,no',
            'user_id' => $request->user_id,
        ]);
       $task->update($request->all());


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Auth::user()->tasks()->findOrFail($id);
        $task->delete();
    }
}
