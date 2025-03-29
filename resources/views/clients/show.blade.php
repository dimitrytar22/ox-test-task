@extends('layouts.main')

@section('title')
    Client {{$client->full_name}}
@endsection


@section('content')
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-lg rounded-xl p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ $client->name }}</h1>

            <div class="bg-gray-100 p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-700 mb-3">Personal Data</h2>
                <table class="w-full border border-gray-300 bg-white rounded-lg">
                    <tbody>
                    <tr class="border-b">
                        <td class="p-3 font-semibold text-gray-700">Name</td>
                        <td class="p-3 text-gray-800">{{ $client->full_name }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-3 font-semibold text-gray-700">Email</td>
                        <td class="p-3 text-gray-800">{{ $client->email }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-3 font-semibold text-gray-700">Phone</td>
                        <td class="p-3 text-gray-800">{{ $client->phone }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-3 font-semibold text-gray-700">Address</td>
                        <td class="p-3 text-gray-800">{{ $client->address }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-3 font-semibold text-gray-700">Created At</td>
                        <td class="p-3 text-gray-800">{{ $client->created_at->format('d M, Y') }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 font-semibold text-gray-700">Updated At</td>
                        <td class="p-3 text-gray-800">{{ $client->updated_at->format('d M, Y') }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="bg-gray-100 p-6 rounded-lg mt-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-3">Orders</h2>
                <table class="w-full border border-gray-300 bg-white rounded-lg">
                    <thead class="bg-gray-200">
                    <tr>
                        <th class="p-3 text-left font-semibold text-gray-700">ID</th>
                        <th class="p-3 text-left font-semibold text-gray-700">Status</th>
                        <th class="p-3 text-left font-semibold text-gray-700">Items</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($client->orders as $order)
                        <tr class="border-b">
                            <td class="p-3 text-gray-800 align-top">{{ $order->id }}</td>
                            <td class="p-3 text-gray-800 align-top">{{ $order->status->title }}</td>
                            <td class="p-3 text-gray-800">
                                @if($order->items->isNotEmpty())
                                    <ul class="list-disc list-inside">
                                        @foreach($order->items as $item)
                                            <li>{{ $item->title }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-gray-500">No items</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('clients.index') }}"
                   class="px-5 py-3 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 transition">
                    Back to List
                </a>
                <a href="{{ route('clients.edit', $client->id) }}"
                   class="px-5 py-3 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 transition">
                    Edit
                </a>
            </div>
        </div>
    </div>
@endsection
