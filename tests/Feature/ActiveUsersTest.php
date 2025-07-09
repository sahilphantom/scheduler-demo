<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActiveUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_only_active_users()
    {
        // Arrange: create active and inactive users
        $activeUser = User::factory()->create(['is_active' => true]);
        $inactiveUser = User::factory()->create(['is_active' => false]);

        // Act: call the endpoint
        $response = $this->getJson('/api/active-users');

        // Assert: check response status and data
        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $activeUser->id])
                 ->assertJsonMissing(['id' => $inactiveUser->id]);
    }
}
