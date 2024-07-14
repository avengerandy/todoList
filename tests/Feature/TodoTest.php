<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Todo;
use Database\Seeders\TodoSeeder;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_return_view_with_empty_list(): void
    {
        $response = $this->get('/');

        $todos = new Collection();

        $response->assertSuccessful();
        $response->assertViewIs('index');
        $response->assertViewHas('todos', $todos);
    }

    public function test_index_return_view_with_todo_list(): void
    {
        $this->seed(TodoSeeder::class);
        $response = $this->get('/');

        $response->assertSuccessful();
        $response->assertViewIs('index');

        $todos = Todo::all();
        $response->assertViewHas('todos', $todos);
    }

    public function test_create_return_view(): void
    {
        $response = $this->get('/create');
        $response->assertSuccessful();
        $response->assertViewIs('create');
    }

    public function test_create_action_validation_error_todo_and_redirect_to_back(): void
    {
        $postData = ['description' => 'updatedDescription'];
        $response = $this->post('/createAction', $postData);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionHasErrors([
            'title' => 'The title field is required.'
        ]);

        $postData = ['title' => 'updatedTitle'];
        $response = $this->withHeaders([
            'Referer' => '/testingPage'
        ])->post('/createAction', $postData);

        $response->assertStatus(302);
        $response->assertRedirect('/testingPage');
        $response->assertSessionHasErrors([
            'description' => 'The description field is required.'
        ]);
    }

    public function test_create_action_todo_and_redirect_to_index(): void
    {
        $postData = [
            'title' => 'updatedTitle',
            'description' => 'updatedDescription',
        ];
        $response = $this->post('/createAction', $postData);

        $response->assertStatus(302);
        $response->assertRedirect('/');

        $todoId = 1;
        $todo = Todo::find($todoId);
        $this->assertEquals($postData['title'], $todo->title);
        $this->assertEquals($postData['description'], $todo->description);

        // flash session test
        $response->assertSessionHas('success', 'created successfully');
        $response = $this->get('/');
        $response->assertSessionMissing('success');
    }

    public function test_detail_return_view_with_todo(): void
    {
        $todoId = 1;

        $this->seed(TodoSeeder::class);
        $response = $this->get("/detail/{$todoId}");

        $response->assertSuccessful();
        $response->assertViewIs('detail');

        $todo = Todo::find($todoId);
        $response->assertViewHas('todo', $todo);
    }

    public function test_edit_return_view_with_todo(): void
    {
        $todoId = 1;

        $this->seed(TodoSeeder::class);
        $response = $this->get("/edit/{$todoId}");

        $response->assertSuccessful();
        $response->assertViewIs('edit');

        $todo = Todo::find($todoId);
        $response->assertViewHas('todo', $todo);
    }

    public function test_update_todo_validation_error_and_redirect_to_back(): void
    {
        $todoId = 1;
        $this->seed(TodoSeeder::class);

        $postData = ['description' => 'updatedDescription'];
        $response = $this->post("/update/{$todoId}", $postData);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionHasErrors([
            'title' => 'The title field is required.'
        ]);

        $postData = ['title' => 'updatedTitle'];
        $response = $this->withHeaders([
            'Referer' => '/testingPage'
        ])->post("/update/{$todoId}", $postData);

        $response->assertStatus(302);
        $response->assertRedirect('/testingPage');
        $response->assertSessionHasErrors([
            'description' => 'The description field is required.'
        ]);
    }

    public function test_update_todo_and_redirect_to_index(): void
    {
        $todoId = 1;

        $this->seed(TodoSeeder::class);
        $postData = [
            'title' => 'updatedTitle',
            'description' => 'updatedDescription',
        ];
        $response = $this->post("/update/{$todoId}", $postData);

        $response->assertStatus(302);
        $response->assertRedirect('/');

        $todo = Todo::find($todoId);
        $this->assertEquals($postData['title'], $todo->title);
        $this->assertEquals($postData['description'], $todo->description);

        // flash session test
        $response->assertSessionHas('success', 'updated successfully');
        $response = $this->get('/');
        $response->assertSessionMissing('success');
    }

    public function test_delete_todo_and_redirect_to_index(): void
    {
        $todoId = 1;

        $this->seed(TodoSeeder::class);
        $todo = Todo::find($todoId);
        $response = $this->post("/delete/{$todoId}");

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertDatabaseCount('todos', 2);
        $this->assertModelMissing($todo);
    }
}
