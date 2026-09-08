@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md mt-6 border">
    <h2 class="text-xl font-bold mb-4 text-gray-800">Editar Cliente</h2>

    {{-- Resumen de errores si existen --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <p class="font-bold">Por favor corrige los siguientes errores:</p>
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nombres --}}
        <div class="mb-4">
            <label for="nombres" class="block text-gray-700 font-medium mb-1">Nombres</label>
            <input type="text" name="nombres" id="nombres" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" value="{{ old('nombres', $cliente->nombres) }}" required>
            @error('nombres')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        {{-- Apellidos --}}
        <div class="mb-4">
            <label for="apellidos" class="block text-gray-700 font-medium mb-1">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" value="{{ old('apellidos', $cliente->apellidos) }}" required>
            @error('apellidos')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        {{-- Documento de Identidad --}}
        <div class="mb-4">
            <label for="documento_identidad" class="block text-gray-700 font-medium mb-1">Documento de Identidad (DUI)</label>
            <input type="text" name="documento_identidad" id="documento_identidad" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" value="{{ old('documento_identidad', $cliente->documento_identidad) }}" required>
            @error('documento_identidad')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        {{-- Teléfono --}}
        <div class="mb-4">
            <label for="telefono" class="block text-gray-700 font-medium mb-1">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" value="{{ old('telefono', $cliente->telefono) }}" required>
            @error('telefono')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        {{-- Correo Electrónico --}}
        <div class="mb-4">
            <label for="correo" class="block text-gray-700 font-medium mb-1">Correo Electrónico</label>
            <input type="email" name="correo" id="correo" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" value="{{ old('correo', $cliente->correo) }}" required>
            @error('correo')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        {{-- Dirección --}}
        <div class="mb-4">
            <label for="direccion" class="block text-gray-700 font-medium mb-1">Dirección</label>
            <textarea name="direccion" id="direccion" rows="3" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" required>{{ old('direccion', $cliente->direccion) }}</textarea>
            @error('direccion')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

       {{-- Estado (Enviando valores booleanos 1 o 0) --}}
        <div class="mb-6">
            <label for="estado" class="block text-gray-700 font-medium mb-1">Estado</label>
            <select name="estado" id="estado" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" required>
                <option value="1" {{ old('estado', $cliente->estado) == 1 || old('estado', $cliente->estado) === true ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ old('estado', $cliente->estado) == 0 || old('estado', $cliente->estado) === false ? 'selected' : '' }}>Inactivo</option>
            </select>
            @error('estado')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        {{-- Botones de Acción --}}
        <div class="flex justify-end space-x-2">
            <a href="{{ route('clientes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 font-semibold">Actualizar Cliente</button>
        </div>
    </form>
</div>
@endsection