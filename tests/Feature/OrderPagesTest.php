<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Order;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderPagesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    private User $user;
    private Order $order;
    use WithFaker;
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->client = Client::factory()->create();
        $status = Status::factory()->create();
        $this->order = Order::factory()->create([
            'client_id' => $this->client->id,
            'status_id' => $status->id,
            'paid_at' => $this->faker()->dateTime()
        ]);
    }

    public function test_show_page_renders(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('orders.show', $this->order->id));

        $response->assertOk();
    }
    public function test_edit_page_renders()
    {
        $response = $this->actingAs($this->user)
            ->get(route('orders.edit', $this->order->id));

        $response->assertOk();
    }
}
