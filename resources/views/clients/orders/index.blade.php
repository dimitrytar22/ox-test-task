@extends('layouts.main')

@section('title')
    Orders {{$client->full_name}}
@endsection

@section('content')
    <a href="{{ url()->previous() }}"
       class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 transition">
        ← Back
    </a>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold text-gray-900 mb-6">Orders List of <b>{{$client->full_name}}</b></h1>
        @if(session()->has('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mt-4 mb-4">
                {{session()->get('success')}}
            </div>
        @endif

        <div class="flex items-center justify-between mb-4">
            <div class="flex space-x-4">

                <form action="" class="status-filter-form" method="GET">
                    <select name="status_id"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 status-filter">
                        <option value="0">All statuses</option>
                        @foreach($statuses as $status)
                            <option
                                value="{{$status->id}}" {{\Illuminate\Support\Facades\Request::get('status_id') == $status->id ? "selected" : ''}}>{{$status->title}}</option>
                        @endforeach
                    </select>
                </form>
            </div>
            <a href="{{route('clients.orders.create', $client->id)}}"
               class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 transition">Add
                Order</a>
        </div>

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gradient-to-r from-blue-500 to-indigo-700 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium">ID</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Products</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Paid at</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Created at</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $order->id }}</td>

                        <td class="px-6 py-4 text-sm text-gray-800">
                            @foreach($order->items as $item)
                                <a href="{{route('orders.show', $order->id)}}">
                                    <div class="border border-gray-300 rounded-lg m-2 p-4 bg-gray-50 shadow-sm">
                                        <h4 class="text-md font-semibold text-gray-800">{{ $item->title }}</h4>
                                        <p class="text-gray-600">Price: {{ $item->price }}$</p>
                                        <p class="text-gray-600">Quantity: {{ $item->pivot->quantity }}</p>
                                    </div>
                                </a>

                            @endforeach
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-800">
                            <p class="text-gray-600">{{ $order->status->title }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-800">
                            @if($order->paid_at)
                                <p class="text-gray-600">{{ $order->paid_at }}</p>
                            @else
                                <p class="text-gray-600">Not paid</p>

                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-800">
                            <p class="text-gray-600">{{ $order->created_at }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-800">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('orders.edit', $order->id) }}"
                                   class="px-2 py-1 bg-blue-500 text-white rounded-sm hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 transition">
                                    Edit
                                </a>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit"
                                            class="px-2 py-1 bg-red-500 text-white rounded-sm hover:bg-red-600 focus:ring-2 focus:ring-red-400 transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$orders->withQueryString()->links()}}
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statusFilter = document.querySelector('.status-filter');
            statusFilter.addEventListener('change', function (event) {
                let filterForm = document.querySelector('.status-filter-form');

                filterForm.submit();
            });
        });
    </script>
@endsection
