@extends('layouts.main')

@section('title')
    Home
@endsection

@section('content')

    <main class="mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-semibold text-gray-800">Welcome to the CRM system, {{ auth()->user()->name }}!</h1>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 shadow-md rounded-lg">
                    <h2 class="text-xl font-semibold text-gray-800">Total Clients</h2>
                    <p class="mt-2 text-gray-600">
                    @if($clientsCount)
                        <p>{{$clientsCount}}</p>
                    @else
                        <p>No clients</p>
                        </p>
                    @endif
                </div>
                <div class="bg-white p-6 shadow-md rounded-lg">
                    <h2 class="text-xl font-semibold text-gray-800">Total Orders</h2>
                    <p class="mt-2 text-gray-600">
                        @if($ordersCount)
                            <p>{{$ordersCount}}</p>
                        @else
                            <p>No orders</p>
                            </p>
                        @endif
                </div>
                <div class="bg-white p-6 shadow-md rounded-lg">
                    <h2 class="text-xl font-semibold text-gray-800">Last Order</h2>
                    <p class="mt-2 text-gray-600">
                        @if($lastOrder)
                            <a href="{{route('orders.show', $lastOrder->id)}}">ID: {{$lastOrder->id}}</a>
                    @else
                        <p>No orders</p>
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </main>

@endsection
