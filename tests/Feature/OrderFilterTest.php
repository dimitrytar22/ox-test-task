<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderFilterTest extends TestCase
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
    public function test_order_can_be_filtered_by_status_id(): void
    {
        $client = Client::factory()->create();
        $status = Status::factory()->create();
        $response = $this->actingAs($this->user)
            ->get(route('clients.orders.index', [
                'client' => $client->id,
                'status_id' => $status->id
            ]));
        $response->assertOk();
    }
}
