<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\TodoController;
use App\Http\Requests\TodoRequest;
use App\Services\TodoService;
use App\Models\Todo;

class TodoControllerTest extends TestCase
{
    public function test_index_method_returns_view_with_Todo_Get(): void
    {
        $mockTodo = $this->mock(Todo::class);
        $expectGetReturn = ['fake01', 'fake02'];
        $mockTodo->expects()->get()->once()->andReturn($expectGetReturn);

        $viewData = ['todos' => $expectGetReturn];
        $expectView = 'fakeView';
        View::shouldReceive('make')->with('index', $viewData)->once()->andReturn($expectView);

        $mockTodoService = $this->mock(TodoService::class);

        $controller = new TodoController($mockTodoService);
        $actualView = $controller->index($mockTodo);

        $this->assertEquals($expectView, $actualView);
    }

    public function test_create_method_returns_view_with_empty_data(): void
    {
        $expectView = 'fakeView';
        View::shouldReceive('make')->with('create')->once()->andReturn($expectView);

        $mockTodoService = $this->mock(TodoService::class);

        $controller = new TodoController($mockTodoService);
        $actualView = $controller->create();

        $this->assertEquals($expectView, $actualView);
    }

    public function test_create_action_method_create_by_request_and_service(): void
    {
        $fakeRequestData = ['fakeRequestData'];
        $mockTodoRequest = $this->mock(TodoRequest::class);
        $mockTodoRequest->expects()->all()->once()->andReturn($fakeRequestData);

        $mockSession = \Mockery::mock();
        $mockSession->expects()->flash('success', 'created successfully')->once();
        $mockTodoRequest->expects()->session()->once()->andReturn($mockSession);

        $mockTodoService = $this->mock(TodoService::class);
        $mockTodoService->expects()->create($fakeRequestData)->once();

        $expectRedirectResponse = 'fakeRedirectResponse';
        Redirect::shouldReceive('to')->with('/')->once()->andReturn($expectRedirectResponse);

        $controller = new TodoController($mockTodoService);
        $actualRedirectResponse = $controller->createAction($mockTodoRequest);

        $this->assertEquals($expectRedirectResponse, $actualRedirectResponse);
    }

    public function test_detail_method_returns_view_with_Todo(): void
    {
        $mockTodo = $this->mock(Todo::class);

        $viewData = ['todo' => $mockTodo];
        $expectView = 'fakeView';
        View::shouldReceive('make')->with('detail', $viewData)->once()->andReturn($expectView);

        $mockTodoService = $this->mock(TodoService::class);

        $controller = new TodoController($mockTodoService);
        $actualView = $controller->detail($mockTodo);

        $this->assertEquals($expectView, $actualView);
    }

    public function test_edit_method_returns_view_with_Todo(): void
    {
        $mockTodo = $this->mock(Todo::class);

        $viewData = ['todo' => $mockTodo];
        $expectView = 'fakeView';
        View::shouldReceive('make')->with('edit', $viewData)->once()->andReturn($expectView);

        $mockTodoService = $this->mock(TodoService::class);

        $controller = new TodoController($mockTodoService);
        $actualView = $controller->edit($mockTodo);

        $this->assertEquals($expectView, $actualView);
    }

    public function test_update_action_method_create_by_request_and_service(): void
    {
        $mockTodo = $this->mock(Todo::class);

        $fakeRequestData = ['fakeRequestData'];
        $mockTodoRequest = $this->mock(TodoRequest::class);
        $mockTodoRequest->expects()->all()->once()->andReturn($fakeRequestData);

        $mockSession = \Mockery::mock();
        $mockSession->expects()->flash('success', 'updated successfully')->once();
        $mockTodoRequest->expects()->session()->once()->andReturn($mockSession);

        $mockTodoService = $this->mock(TodoService::class);
        $mockTodoService->expects()->update($fakeRequestData, $mockTodo)->once();

        $expectRedirectResponse = 'fakeRedirectResponse';
        Redirect::shouldReceive('to')->with('/')->once()->andReturn($expectRedirectResponse);

        $controller = new TodoController($mockTodoService);
        $actualRedirectResponse = $controller->update($mockTodo, $mockTodoRequest);

        $this->assertEquals($expectRedirectResponse, $actualRedirectResponse);
    }

    public function test_delete_method_delete_Todo_and_redirect_to_index(): void
    {
        $mockTodo = $this->mock(Todo::class);
        $mockTodo->expects()->delete()->once();

        $expectRedirectResponse = 'fakeRedirectResponse';
        Redirect::shouldReceive('to')->with('/')->once()->andReturn($expectRedirectResponse);

        $mockTodoService = $this->mock(TodoService::class);

        $controller = new TodoController($mockTodoService);
        $actualRedirectResponse = $controller->delete($mockTodo);

        $this->assertEquals($expectRedirectResponse, $actualRedirectResponse);
    }
}
