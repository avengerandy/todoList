<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use App\Http\Requests\TodoRequest;
use App\Services\TodoService;
use App\Models\Todo;

class TodoController extends Controller
{
    private TodoService $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function index(Todo $todo) {
        $todos = $todo->get();
        return View::make('index', ['todos' => $todos]);
    }

    public function create() {
        return View::make('create');
    }

    public function createAction(TodoRequest $request) {
        $data = $request->all();

        $this->todoService->create($data);

        $request->session()->flash('success', 'created succesfully');
        return Redirect::to('/');
    }

    public function detail(Todo $todo) {
        return View::make('detail', ['todo' => $todo]);
    }

    public function edit(Todo $todo) {
        return View::make('edit', ['todo' => $todo]);
    }

    public function update(Todo $todo, TodoRequest $request) {
        $data = $request->all();

        $this->todoService->update($data, $todo);

        $request->session()->flash('success', 'updated successfully');
        return Redirect::to('/');
    }

    public function delete(Todo $todo) {
        $todo->delete();
        return Redirect::to('/');
    }
}
