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
            'status_id' => $data['status_id'],
        ]);

        $items = $data['items'];

        $itemsWithQuantity = [];
        foreach ($items as $item) {
            $itemsWithQuantity[$item['item_id']] = ['quantity' => $item['quantity']];
        }
        $order->paid_at = $data['paid_at'];
        $order->save();
        $order->items()->attach($itemsWithQuantity);
    }

    public function update(UpdateRequest $request, Order $order)
    {
        $data = $request->validated();

        $items = $data['items'];

        $itemsWithQuantity = [];
        foreach ($items as $item) {
            $itemsWithQuantity[$item['item_id']] = ['quantity' => $item['quantity']];
        }
        $order->paid_at = $data['paid_at'];
        $order->status_id = $data['status_id'];
        $order->save();
        $order->items()->sync($itemsWithQuantity);
    }

    public function destroy(Order $order)
    {
        $order->items()->detach();
        $order->delete();
    }


}
