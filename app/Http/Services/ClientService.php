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
        Client::query()->firstOrCreate([
            'email',
            'phone'
        ],$data);
    }

    public function destroy(Client $client)
    {
        $orders = $client->orders;
        foreach ($orders as $order){
            $order->delete();
        }
        $client->delete();
    }

}
