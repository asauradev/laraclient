@extends('layouts.app')

@section('title', 'Listado de Clientes')

@section('content')
    <div class="mb-4">
        <a href="{{ route('clients.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Nuevo cliente</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($clients as $client)
            <div class="bg-white shadow rounded p-4">
                <h2 class="text-lg font-semibold">{{ $client->name }}</h2>
                <p class="text-sm text-gray-500">{{ $client->email }}</p>
                @if($client->photo)
                    <img src="{{ asset('storage/' . $client->photo) }}" class="w-full h-48 object-cover mt-2 mb-2 rounded">
                @endif

                <div class="flex gap-3">
                    <a href="{{ route('clients.edit', $client) }}" class="text-blue-600 hover:underline">Editar</a>

                    <form action="{{ route('clients.destroy', $client) }}" method="POST" onsubmit="return confirm('¿Eliminar cliente?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:underline">Eliminar</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
