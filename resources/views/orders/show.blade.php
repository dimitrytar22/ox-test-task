@extends('layouts.main')

@section('title')
    Order Details
@endsection

@section('content')
    <a href="{{ url()->previous() }}"
       class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 transition">
        ← Back
    </a>

    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-6">Order №{{ $order->id }}</h1>

            <p><strong>Status:</strong> {{ $order->status->title }}</p>
            <p><strong>Client:</strong> <a href="{{route('clients.show',$order->client->id)}}">{{ $order->client->full_name }}</a></p>
            <p><strong>Created at:</strong> {{\Carbon\Carbon::parse($order->created_at )->format('d.m.Y H:i') }}</p>
            <p><strong>Paid at:</strong> {{ $order->paid_at ?\Carbon\Carbon::parse($order->paid_at )->format('d.m.Y H:i')  : 'Not paid' }}</p>

            <h2 class="text-xl font-semibold mt-6 mb-2">Items</h2>
            <div class="border border-gray-300 rounded-md p-4">
                <table class="w-full">
                    <thead>
                    <tr class="border-b">
                        <th class="text-left p-2">Item</th>
                        <th class="text-left p-2">Quantity</th>
                        <th class="text-left p-2">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->items as $item)
                        <tr class="border-b">
                            <td class="p-2">{{ $item->title }}</td>
                            <td class="p-2">{{ $item->pivot->quantity }}</td>
                            <td class="p-2">${{ number_format($item->price, 2) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <p class="mt-4 text-lg font-bold">Total Price:
                ${{ $order->sum()}}</p>

            <a href="{{ route('orders.edit', $order->id) }}"
               class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 transition">
                Edit Order
            </a>
        </div>
    </div>
@endsection
