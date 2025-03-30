<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_main_page_renders(): void
    {
        $user = User::factory(1)->create()->first();

        $response = $this
            ->actingAs($user)
            ->get('/');

        $response->assertStatus(200);
    }

    public function test_unauthorized_user_redirects_to_login(): void
    {
        $response = $this->get('/');
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }
}
