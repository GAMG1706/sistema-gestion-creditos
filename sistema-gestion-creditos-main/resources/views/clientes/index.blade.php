@extends('layouts.app')

@content
@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-6 bg-slate-900 text-white flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h1 class="text-xl font-bold">Gestión de Clientes</h1>
            <p class="text-xs text-slate-400">Consulta, busca y gestiona el registro de clientes</p>
        </div>
        <a href="{{ route('clientes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm px-4 py-2 rounded-lg transition shadow">
            <i class="fa-solid fa-user-plus mr-1.5"></i> Nuevo Cliente
        </a>
    </div>

    <div class="p-4 bg-gray-50 border-b border-gray-200">
        <form action="{{ route('clientes.index') }}" method="GET" class="flex gap-2">
            <input type="text" name="buscar" value="{{ $buscar }}" placeholder="Buscar por nombre, apellido o documento..." class="w-full text-sm border-gray-300 rounded-lg px-4 py-2 border focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <button type="submit" class="bg-slate-800 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-slate-700 transition">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm text-gray-600">
            <thead class="bg-gray-100 text-gray-700 uppercase font-semibold text-xs border-b">
                <tr>
                    <th class="p-4">Cliente</th>
                    <th class="p-4">Documento</th>
                    <th class="p-4">Contacto</th>
                    <th class="p-4">Estado</th>
                    <th class="p-4 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($clientes as $cliente)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 font-medium text-gray-900">{{ $cliente->nombres }} {{ $cliente->apellidos }}</td>
                    <td class="p-4">{{ $cliente->documento_identidad }}</td>
                    <td class="p-4">{{ $cliente->telefono }} <br> <span class="text-xs text-gray-400">{{ $cliente->correo }}</span></td>
                    <td class="p-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $cliente->estado ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                            {{ $cliente->estado ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td class="p-4 text-center space-x-2">
                        <a href="{{ route('clientes.show', $cliente) }}" class="text-blue-600 hover:text-blue-800 font-medium text-xs"><i class="fa-solid fa-eye"></i> Historial</a>
                        <a href="{{ route('clientes.edit', $cliente) }}" class="text-slate-600 hover:text-slate-800 font-medium text-xs"><i class="fa-solid fa-pen"></i> Editar</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-500">No se encontraron clientes registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-4">
        {{ $clientes->links() }}
    </div>
</div>
@endsection