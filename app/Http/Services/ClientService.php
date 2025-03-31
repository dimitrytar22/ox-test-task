<?php

namespace App\Http\Services;

use App\Http\Requests\Client\StoreRequest;
use App\Http\Requests\Client\UpdateRequest;
use App\Models\Client;
use App\Models\Item;
use App\Models\Order;
use App\Models\Status;
use Mockery\Exception;

class ClientService
{


    public function update(UpdateRequest $request, Client $client)
    {
        $data = $request->validated();
        $client->update($data);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        return Client::query()->firstOrCreate([
            'email' => $data['email'],
            'phone' => $data['phone'],
        ], $data);

    }

    public function destroy(Client $client)
    {
        $orders = $client->orders;
        foreach ($orders as $order) {
            $order->items()->detach();
            $order->delete();
        }
        $client->delete();
    }

    public static function importClients()
    {

        try {
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
                    ], [
                        'title' => $order['status']
                    ]);
                    $createdOrder = Order::query()->createOrFirst([
                        'client_id' => $createdClient->id,
                        'status_id' => $createdStatus->id
                    ], ['client_id' => $createdClient->id,
                        'status_id' => $createdStatus->id
                    ]);
                    foreach ($items as $item) {
                        $createdItem = Item::query()->firstOrCreate([
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
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

}
