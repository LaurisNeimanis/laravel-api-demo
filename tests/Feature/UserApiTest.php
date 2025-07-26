<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_all_seeded_users(): void
    {
        // Seed the database with DatabaseSeeder (20 random + 1 test user)
        $this->seed();

        // Hit the /api/users endpoint
        $response = $this->getJson('/api/users');

        // Assert status 200 and exactly 21 items in the JSON "data"
        $response->assertStatus(200)
                 ->assertJsonCount(21, 'data')
                 ->assertJsonFragment([
                     'email' => 'test@example.com',
                     'name'  => 'Test User',
                 ]);
    }
}
