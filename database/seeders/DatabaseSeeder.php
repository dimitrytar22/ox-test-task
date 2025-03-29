<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Client;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Status::query()->create([
            'title' => 'awaiting payment'
        ]);
        Status::query()->create([
            'title' => 'paid'
        ]);
        Status::query()->create([
            'title' => 'canceled'
        ]);

        Client::factory(1000)->create();
        Order::factory(30)->create();
    }
}
