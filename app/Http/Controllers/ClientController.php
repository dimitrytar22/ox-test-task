<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\StoreRequest;
use App\Http\Requests\Client\UpdateRequest;
use App\Http\Services\ClientService;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{


    public function __construct(public ClientService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::query()->paginate(20);
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $client = $this->service->store($request);
        return redirect()->route('clients.index')->with('success', "Client ID: $client->id created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Client $client)
    {
        $this->service->update($request,$client);
        return redirect()->route('clients.index')->with('success', "Client ID: $client->id updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $this->service->destroy($client);
        return redirect()->route('clients.index')->with('success', "Client ID: $client->id deleted successfully!");
    }
}
