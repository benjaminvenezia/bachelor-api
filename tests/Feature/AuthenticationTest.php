<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
 
    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();
 
        $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
 
        $this->assertAuthenticated();
    }
 
    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = User::factory()->create();
 
        $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);
 
        $this->assertGuest();
    }
}
