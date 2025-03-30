<?php

namespace App\Http\Services;

use App\Http\Requests\Client\StoreRequest;
use App\Http\Requests\Client\UpdateRequest;
use App\Models\Client;

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
        ],$data);

    }

    public function destroy(Client $client)
    {
        $orders = $client->orders;
        foreach ($orders as $order){
            $order->items()->detach();
            $order->delete();
        }
        $client->delete();
    }

}
