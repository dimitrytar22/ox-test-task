@extends('layouts.main')

@section('title')
    Client {{$client->full_name}}
@endsection


@section('content')
    <a href="{{ url()->previous() }}"
       class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 transition">
        ← Back
    </a>
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
                        <td class="p-3 font-semibold text-gray-700">Birthday</td>
                        <td class="p-3 text-gray-800">{{ $client->date_of_birth }}</td>
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

            <div class="flex justify-between mt-6">
                <a href="{{ route('clients.orders.index', $client->id) }}"
                   class="px-5 py-3 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 transition">
                    Orders
                </a>
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
