@extends('layouts.main')


@section('title')
    Edit client
@endsection

@section('content')
    <a href="{{ route('clients.index')}}"
       class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 transition">
        ← Back
    </a>
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-6">Client: {{ $client->full_name }}</h1>
            <h2 class="text-2 font-semibold mb-6">ID: {{$client->id}}</h2>


            <form action="{{ route('clients.update', $client->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="flex flex-col">
                    <label for="full_name" class="text-gray-700 font-medium">Full Name</label>
                    <input type="text" name="full_name" id="full_name"
                           value="{{ old('full_name') ?? $client->full_name }}" placeholder="e.g. Mr. Milton Jerde"
                           class="mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                @error('full_name')
                    <x-input-error :messages="$message"/>


                @enderror

                <div class="flex flex-col">
                    <label for="email" class="text-gray-700 font-medium">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') ?? $client->email }}" placeholder="e.g. leanna.harber@kuhn.org"
                           class="mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                @error('email')
                <x-input-error :messages="$message"/>

                @enderror

                <div class="flex flex-col">
                    <label for="phone" class="text-gray-700 font-medium">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') ?? $client->phone }}" placeholder="Format e.g. +17188975450"
                           class="mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                @error('phone')
                <x-input-error :messages="$message"/>

                @enderror

                <div class="flex flex-col">
                    <label for="address" class="text-gray-700 font-medium">Address</label>
                    <input type="text" name="address" id="address" value="{{ old('address') ?? $client->address }}" placeholder="e.g. 96173 Schmitt Junction Champlain, GA 61919"
                           class="mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                @error('address')
                <x-input-error :messages="$message"/>

                @enderror

                <div>
                    <button type="submit"
                            class="w-full mt-4 p-3 text-white font-semibold rounded-lg bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Save
                    </button>
                    <form action="{{route('clients.destroy',$client->id)}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit"
                                class="w-full mt-4 p-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                            Delete
                        </button>
                    </form>
                </div>
            </form>
        </div>
    </div>
@endsection
