<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\SearchClientRequest;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Requests\Order\UpdateRequest;
use App\Http\Resources\ClientResource;
use App\Http\Services\OrderService;
use App\Models\Client;
use App\Models\Item;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(public OrderService $service)
    {

    }


    /**
     * Display a listing of the resource.
     */
    public function index(Client $client)
    {
        $orders = $client->orders()->paginate(20);
        $statuses = Status::all();
        return view('clients.orders.index', compact( 'orders','client', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Client $client)
    {
        $items = Item::all();
        $statuses = Status::all();
        return view('clients.orders.create', compact('client', 'items', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Client $client)
    {
        $this->service->store($request,$client);
        return redirect()->route('clients.orders.index', compact('client'))->with('success', 'Order added successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $statuses = Status::all();
        return view('orders.edit', compact('order', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Order $order)
    {
        $this->service->update($request,$order);
        return redirect()->route('clients.orders.index', $order->client->id)->with('success', "Order ID: $order->id updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $this->service->destroy($order);
        return redirect()->back()->with('success', "Successfully deleted order");
    }
}
