<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class DefaultGageTest extends TestCase
{
    public function test_fetched_defaults_gages_are_correctly_fetched_when_authenticated()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/default_gages');

        $response->assertStatus(200);
        //$this->assertEquals(1, count($response->json()));
    }
}
