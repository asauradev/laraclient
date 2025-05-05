@extends('layouts.app')

@section('title', isset($client) ? 'Editar Cliente' : 'Nuevo Cliente')

@section('content')
    <form action="{{ isset($client) ? route('clients.update', $client) : route('clients.store') }}"
          method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow space-y-4">

        @csrf
        @isset($client)
            @method('PUT')
        @endisset

        <div>
            <label class="block font-medium">Nombre:</label>
            <input type="text" name="name" value="{{ old('name', $client->name ?? '') }}" class="w-full border p-2 rounded">
            @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium">Email:</label>
            <input type="email" name="email" value="{{ old('email', $client->email ?? '') }}" class="w-full border p-2 rounded">
            @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium">Foto:</label>
            <input type="file" name="photo" class="w-full border p-2 rounded">
            @error('photo') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

            @if(isset($client) && $client->photo)
                <img src="{{ asset('storage/' . $client->photo) }}" class="w-24 mt-2 rounded">
            @endif
        </div>

        <div>
            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                {{ isset($client) ? 'Actualizar' : 'Guardar' }}
            </button>
            <a href="{{ route('clients.index') }}" class="ml-4 text-gray-600 hover:underline">Cancelar</a>
        </div>
    </form>
@endsection
