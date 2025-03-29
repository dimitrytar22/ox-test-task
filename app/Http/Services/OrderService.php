<?php

namespace App\Http\Services;

use App\Http\Requests\Order\SearchClientRequest;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Requests\Order\UpdateRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Models\Order;
use App\Models\Status;

class OrderService
{
    public function store(StoreRequest $request, Client $client)
    {
        $data = $request->validated();

        $order = Order::query()->create([
            'client_id' => $client->id,
            'status_id' => Status::query()->where('title', 'awaiting payment')->first()->id,
        ]);

        $items = json_decode($request->input('items'), true);

        $itemsWithQuantity = [];
        foreach ($items as $item) {
            $itemsWithQuantity[$item['item_id']] = ['quantity' => $item['quantity']];
        }

        $order->items()->attach($itemsWithQuantity);
    }

    public function update(UpdateRequest $request, Order $order)
    {

    }

    public function destroy(Order $order)
    {

    }


}
