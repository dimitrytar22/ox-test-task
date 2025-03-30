<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Item;
use App\Models\Order;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use WithFaker;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_store_order(): void
    {
        $client = Client::factory()->create();
        $status = Status::factory()->create();
        $items = Item::factory(2)->create();

        $orderData = [
            'client_id' => $client->id,
            'status_id' => $status->id,
            'paid_at' => $this->faker()->dateTime()->format('Y-m-d H:i:s'),
            'items' => [
                [
                    'item_id' => $items->get(0)->id,
                    'quantity' => 10,
                ],
                [
                    'item_id' => $items->get(1)->id,
                    'quantity' => 200,
                ]
            ]
        ];
        $this->actingAs($this->user)
            ->post(route('clients.orders.store', $client->id), $orderData);

        $this->assertDatabaseHas('orders', [
            'client_id' => $client->id,
            'status_id' => $status->id,
        ]);

    }

    public function test_can_update_order()
    {
        $client = Client::factory()->create();
        $status = Status::factory()->create();
        $items = Item::factory(2)->create();
        $order = Order::query()->create([
            'client_id' => $client->id,
            'status_id' => $status->id,
            'paid_at' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
        ]);
        $newStatus = Status::factory()->create();
        $orderUpdateData = [
            'status_id' => $newStatus->id,
            'paid_at' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
            'items' => [
                [
                    'item_id' => $items->get(0)->id,
                    'quantity' => 100
                ],
                [
                    'item_id' => $items->get(1)->id,
                    'quantity' => 400
                ]
            ]
        ];

        $this->actingAs($this->user)
            ->put(route('orders.update', $order->id), $orderUpdateData);

        $this->assertDatabaseHas('orders', [
            'status_id' => $orderUpdateData['status_id'],
            'paid_at' => $orderUpdateData['paid_at'],
        ]);
    }

    public function test_can_destroy_order()
    {
        $client = Client::factory()->create();
        $status = Status::factory()->create();
        $order = Order::query()->create([
            'client_id' => $client->id,
            'status_id' => $status->id,
            'paid_at' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
        ]);
        $this->actingAs($this->user)
            ->delete(route('orders.destroy', $order->id));
        $this->assertDatabaseMissing('orders', [
            'id' => $order->id
        ]);
    }

    public function test_can_attach_items_to_order()
    {
        $client = Client::factory()->create();
        $status = Status::factory()->create();
        $createdItems = Item::factory(2)->create();
        $items = [];
        foreach ($createdItems as $item) {
            $items[$item->id] = ['quantity' => 10];
        }
        $order = Order::query()->create([
            'client_id' => $client->id,
            'status_id' => $status->id,
            'paid_at' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
        ]);
        $order->items()->attach($items);
        foreach ($createdItems as $item) {
            $this->assertDatabaseHas('items_order', [
                'order_id' => $order->id,
                'item_id' => $item->id
            ]);
        }
    }
}
