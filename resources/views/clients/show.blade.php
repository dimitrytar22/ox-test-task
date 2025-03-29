@extends('layouts.main')

@section('content')
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-4">Client: {{ $client->name }}</h1>
            <p class="text-gray-700 mb-6">{{ $client->email }}</p>

            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Details</h2>
                <ul class="list-disc pl-5">
                    <li><strong>Name:</strong> {{ $client->name }}</li>
                    <li><strong>Email:</strong> {{ $client->email }}</li>
                    <li><strong>Phone:</strong> {{ $client->phone }}</li>
                    <li><strong>Address:</strong> {{ $client->address }}</li>
                    <li><strong>Created At:</strong> {{ $client->created_at->format('d M, Y') }}</li>
                    <li><strong>Updated At:</strong> {{ $client->updated_at->format('d M, Y') }}</li>
                </ul>
            </div>

            <div class="flex justify-between mt-4">
                <a href="{{ route('clients.index') }}" class="text-blue-600 hover:text-blue-800">Back to list</a>
                <a href="{{ route('clients.edit', $client->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
            </div>
        </div>
    </div>
@endsection
