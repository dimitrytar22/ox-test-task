<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => Client::all()->random(1)->first()->id,
            'status_id' => Status::all()->random(1)->first()->id,
            'paid_at' => $this->faker->dateTime(),
        ];
    }
}
