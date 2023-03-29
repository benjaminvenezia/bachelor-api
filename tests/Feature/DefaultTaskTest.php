<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class DefaultTaskTest extends TestCase
{

    public function test_defaults_task_are_correctly_fetched()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/default_tasks');

        $response->assertStatus(200);
        $this->assertEquals(1, count($response->json()));
    }

    public function test_defaults_task_are_correctly_formatted()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/default_tasks');

        $response->assertJsonStructure([
            "data" => [
                0 => [
                    "id",
                    "category",
                    "title",
                    "description",
                    "reward",
                    "path_icon_todo",
                ]
            ]
        ]);
    }
}
