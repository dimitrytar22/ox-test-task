<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ClientTest extends TestCase
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


    public function test_can_create_client(): void
    {
        $clientData = [
            'full_name' => $this->faker()->name,
            'email' => $this->faker()->email,
            'address' => $this->faker()->address,
            'phone' => "+380958888888",
            'date_of_birth' => $this->faker()->date()
        ];

        $response = $this->actingAs($this->user)
            ->post(route('clients.store'), $clientData);
        $this->assertDatabaseHas('clients', [
            'email' => $clientData['email']
        ]);
    }

    public function test_can_edit_client(): void
    {
        $client = Client::factory()->create();
        $newClientData = [
            'full_name' => $this->faker()->name,
            'email' => "newEditedEmail@gmail.com",
            'address' => $this->faker()->address,
            'phone' => "+380954918129328139",
            'date_of_birth' => $this->faker()->date()
        ];

        $response = $this->actingAs($this->user)
            ->put(route('clients.update', $client->id), $newClientData);
        $this->assertDatabaseHas('clients', $newClientData);
    }

    public function test_can_destroy_client()
    {
        $client = Client::factory()->create();
        $response = $this->actingAs($this->user)
            ->delete(route('clients.destroy', $client->id));
        $this->assertDatabaseMissing('clients', ['id' => $client->id]);
    }
}
