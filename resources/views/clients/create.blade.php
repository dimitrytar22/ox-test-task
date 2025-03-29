@extends('layouts.main')

@section('title')
    Create client
@endsection


@section('content')
    <a href="{{ route('clients.index')}}"
       class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 transition">
        ← Back
    </a>
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-6">Create Client</h1>


            <form action="{{ route('clients.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="flex flex-col">
                    <label for="full_name" class="text-gray-700 font-medium">Full Name</label>
                    <input type="text" name="full_name" id="full_name" placeholder="e.g. Mr. Milton Jerde"
                           value="{{ old('full_name')  }}"
                           class="mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                @error('full_name')
                <x-input-error :messages="$message"/>
                @enderror

                <div class="flex flex-col">
                    <label for="email" class="text-gray-700 font-medium">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                           placeholder="e.g. leanna.harber@kuhn.org"
                           class="mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                @error('email')
                <x-input-error :messages="$message"/>

                @enderror

                <div class="flex flex-col">
                    <label for="phone" class="text-gray-700 font-medium">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                           placeholder="Format e.g. +17188975450"
                           class="mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                @error('phone')
                <x-input-error :messages="$message"/>
                @enderror

                <div class="flex flex-col">
                    <label for="address" class="text-gray-700 font-medium">Address</label>
                    <input type="text" name="address" id="address" value="{{ old('address') }}"
                           placeholder="e.g. 96173 Schmitt Junction Champlain, GA 61919"
                           class="mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                @error('address')
                <x-input-error :messages="$message"/>

                @enderror

                <div>
                    <button type="submit"
                            class="w-full mt-4 p-3 text-white bg-blue-500 font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
