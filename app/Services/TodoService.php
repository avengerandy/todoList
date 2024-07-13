<?php

namespace App\Services;
use App\Models\Todo;

class TodoService
{
    protected Todo $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function create(array $todoData): Todo
    {
        $this->todo->title = $todoData['title'];
        $this->todo->description = $todoData['description'];
        $this->todo->save();
        $todo = $this->todo->replicate();
        $this->todo = $this->todo->newModelInstance();

        return $todo;
    }

    public function update(array $todoData, Todo $todo): Todo
    {
        $todo->title = $todoData['title'];
        $todo->description = $todoData['description'];
        $todo->save();

        return $todo;
    }
}
