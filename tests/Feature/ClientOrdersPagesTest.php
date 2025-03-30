<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Order;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientOrdersPagesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    private User $user;
    private Client $client;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->client = Client::factory()->create();
        $status = Status::factory()->create();
        $order = Order::factory()->create([
            'client_id' => $this->client->id,
            'status_id' => $status->id,
            'paid_at' => $this->faker()->dateTime()
        ]);
    }

    public function test_index_page_renders()
    {

        $response = $this->actingAs($this->user)
            ->get(route('clients.orders.index', $this->client->id));
        $response->assertOk();
    }
    public function test_create_page_renders()
    {
        $response = $this->actingAs($this->user)
            ->get(route('clients.orders.create', $this->client->id));
        $response->assertOk();
    }
}
