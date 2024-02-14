<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::with('category')->where('user_id', auth()->user()->id)->get();
        $categories = Category::all();

        return view('home.index', [
            'todos' => $todos,
            'categories' => $categories
        ]);
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
        $newTodoActivity = $request->input('todo-item');
        $defaultStatus = "PENDING";
        $todoCategory = $request->input('todo-category');
        $userId = $request->user()->id;

        Todo::create(['activity' => $newTodoActivity, 'status' => $defaultStatus, 'user_id' => $userId, 'category_id' => $todoCategory]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $todo->update(['status' => 'DONE']);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->back();
    }
}
