<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class PostApiTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function authenticated_user_can_get_posts(): void
    {
        $user = User::factory()->create();
        Post::factory()->count(2)->create(['user_id' => $user->id]);

        // ✅ Authenticate user
        Sanctum::actingAs($user);

        $response = $this->getJson('/api/posts');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'title', 'body', 'created_at', 'updated_at']
            ]
        ]);
    }

    #[Test]
    public function unauthenticated_user_cannot_get_posts(): void
    {
        $response = $this->getJson('/api/posts');

        $response->assertStatus(401); // Unauthorized
    }

    #[Test]
    public function returns_empty_array_if_user_has_no_posts(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->getJson('/api/posts');

        $response->assertStatus(200);
        $response->assertJson(['data' => []]);
    }
}
