<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientPagesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    private User $user;
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_index_page_renders(): void
    {

        $response = $this->actingAs($this->user)
            ->get(route('clients.index'));

        $response->assertStatus(200);
    }
    public function test_create_page_renders()
    {

        $response = $this->actingAs($this->user)
            ->get(route('clients.create'));

        $response->assertStatus(200);
    }

    public function test_show_page_renders()
    {
        $client = Client::factory()->create();

        $response = $this->actingAs($this->user)
            ->get(route('clients.show', $client->id));
        $response->assertOk();
    }

    public function test_edit_page_renders()
    {
        $client = Client::factory()->create();

        $response = $this->actingAs($this->user)
            ->get(route('clients.edit', $client->id));
        $response->assertOk();
    }
}
