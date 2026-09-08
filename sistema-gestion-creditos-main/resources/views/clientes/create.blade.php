@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-6 bg-slate-900 text-white">
        <h1 class="text-lg font-bold"><i class="fa-solid fa-user-plus mr-2"></i>Registrar Nuevo Cliente</h1>
    </div>
    <form action="{{ route('clientes.store') }}" method="POST" class="p-6 space-y-4">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nombres</label>
                <input type="text" name="nombres" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Apellidos</label>
                <input type="text" name="apellidos" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Documento Identidad</label>
                <input type="text" name="documento_identidad" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Teléfono</label>
                <input type="text" name="telefono" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Correo Electrónico</label>
            <input type="email" name="correo" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Dirección</label>
            <textarea name="direccion" rows="3" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
        </div>
        <div class="flex justify-end gap-3 pt-4 border-t">
            <a href="{{ route('clientes.index') }}" class="px-4 py-2 border rounded-lg text-sm text-gray-600 hover:bg-gray-100">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 font-medium">Guardar Cliente</button>
        </div>
    </form>
</div>
@endsection