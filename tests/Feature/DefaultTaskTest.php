<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class DefaultTaskTest extends TestCase
{
    public function test_fetched_defaults_task_returns_a_successful_response()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/default_tasks');

        $response->assertStatus(200);
    }

    public function test_fetched_defaults_task_route_return_unauthenticated_without_token()
    {
        $this->withoutExceptionHandling();
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->getJson('/api/default_tasks');
    }

    public function test_fetched_defaults_task_are_correctly_structured()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/default_tasks');

        $response->assertJsonStructure([
            "data" => [
                "*" => ["id", "category", "title", "description", "reward", "path_icon_todo"]
            ]
        ]);
       
    }

    public function test_fetched_defaults_task_types_are_corrects()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/default_tasks');

        $response->assertJson(fn (AssertableJson $json) =>
            $json->whereType('data.0.id', 'integer')
                ->whereType('data.0.category', 'string')
                ->whereType('data.0.title', 'string')
                ->whereType('data.0.description', 'string')
                ->whereType('data.0.reward', 'integer')
                ->whereType('data.0.path_icon_todo', 'string')
    );
     
    }
}
