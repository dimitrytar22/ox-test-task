@extends('layouts.main')

@section('title')
    Clients
@endsection

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold text-gray-900 mb-6">Client List</h1>
        @if(session()->has('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mt-4 mb-4">
                {{session()->get('success')}}
            </div>
        @endif

        <div class="flex items-center justify-between mb-4">

            <a href="{{route('clients.create')}}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 transition">Add Client</a>
        </div>

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gradient-to-r from-blue-500 to-indigo-700 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium">ID</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Phone</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($clients as $client)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $client->id }}</td>

                        <td class="px-6 py-4 text-sm text-gray-800"><a href="{{route('clients.show', $client->id)}}">{{ $client->full_name }}</a></td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $client->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $client->phone }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('clients.edit', $client->id) }}" class="px-2 py-1 bg-blue-500 text-white rounded-sm hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 transition">
                                    Edit
                                </a>
                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded-sm hover:bg-red-600 focus:ring-2 focus:ring-red-400 transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$clients->links()}}
        </div>
    </div>
@endsection
