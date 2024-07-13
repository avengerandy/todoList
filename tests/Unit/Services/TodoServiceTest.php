<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\TodoService;
use App\Models\Todo;

class TodoServiceTest extends TestCase
{
    public function test_create_return_saved_todo_and_init(): void
    {
        $todoData = [
            'title' => 'fakeTitle',
            'description' => 'fakeDescription',
        ];
        $mockServiceTodo = $this->mock(Todo::class);
        $mockServiceTodo->expects()->setAttribute('title', $todoData['title'])->once();
        $mockServiceTodo->expects()->setAttribute('description', $todoData['description'])->once();
        $mockServiceTodo->expects()->save()->once();
        $mockServiceTodo->expects()->replicate()->once()->andReturnSelf();
        $mockModelInstanceTodo = $this->mock(Todo::class);
        $mockServiceTodo->expects()->newModelInstance()->once()->andReturn($mockModelInstanceTodo);

        $service = new class($mockServiceTodo) extends TodoService
        {
            public function getTodo()
            {
                return $this->todo;
            }
        };
        $todo = $service->create($todoData);

        $this->assertEquals($mockServiceTodo, $todo);
        $this->assertEquals($mockModelInstanceTodo, $service->getTodo());
    }

    public function test_update_return_updated_todo(): void
    {
        $todoData = [
            'title' => 'fakeTitle',
            'description' => 'fakeDescription',
        ];
        $mockUpdateTodo = $this->mock(Todo::class);
        $mockUpdateTodo->expects()->setAttribute('title', $todoData['title'])->once();
        $mockUpdateTodo->expects()->setAttribute('description', $todoData['description'])->once();
        $mockUpdateTodo->expects()->save()->once();

        $mockServiceTodo = $this->mock(Todo::class);
        $service = new TodoService($mockServiceTodo);
        $todo = $service->update($todoData, $mockUpdateTodo);

        $this->assertEquals($mockUpdateTodo, $todo);
    }
}
