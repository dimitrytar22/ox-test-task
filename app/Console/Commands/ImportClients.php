<?php

namespace App\Console\Commands;

use App\Http\Services\ClientsAPIService;
use App\Models\Client;
use App\Models\Item;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Console\Command;

class ImportClients extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:clients';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import clients and their orders from API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $clients = ClientsAPIService::getClients();
        foreach ($clients as $client) {
            $orders = $client['orders'];
            $createdClient = Client::query()->createOrFirst([
                'email' => $client['email'],
                'phone' => $client['phone']
            ], [
                'full_name' => $client['full_name'],
                'email' => $client['email'],
                'phone' => $client['phone'],
                'address' => $client['address'],
                'date_of_birth' => $client['date_of_birth']
            ]);
            foreach ($orders as $order) {
                $items = $order['items'];
                $createdStatus = Status::query()->firstOrCreate([
                    'title' => $order['status'],
                ],[
                    'title' => $order['status']
                ]);
                $createdOrder = Order::query()->createOrFirst([
                    'client_id' => $createdClient->id,
                    'status_id' => $createdStatus->id
                ], ['client_id' => $createdClient->id,
                    'status_id' => $createdStatus->id
                ]);
                foreach ($items as $item) {
                    $createdItem = Item::query()->createOrFirst([
                        'title' => $item['title'],
                        'price' => $item['price']
                    ], [
                        'title' => $item['title'],
                        'price' => $item['price']
                    ]);
                    $itemQuantity = $item['quantity'];
                    $dataToAttach = [
                        $createdItem->id => ['quantity' => $itemQuantity]
                    ];
                    $createdOrder->items()->attach($dataToAttach);
                }

            }
        }
    }
}
