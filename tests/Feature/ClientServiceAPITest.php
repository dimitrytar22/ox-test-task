<?php

namespace Tests\Feature;

use App\Http\Services\ClientsAPIService;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientServiceAPITest extends TestCase
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

    public function test_can_get_clients(): void
    {
        $data = ClientsAPIService::getClients();


        $this->assertIsArray($data);
    }
}
