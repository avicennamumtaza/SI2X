<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Users;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     */
    public function test_users_factory(): void
    {
        // Create dummy data using factory
        $user = Users::factory()->create();

        // Assert that the data is created successfully
        $this->assertNotNull($user);
    }

    public function test_login(): void
    {
        $response = $this->post('/login', [
            'email' => 'database.no7@gmail.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/home');
    }

    // Other test methods...
}
