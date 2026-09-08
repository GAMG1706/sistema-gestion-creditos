@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-6 bg-slate-900 text-white">
        <h1 class="text-lg font-bold"><i class="fa-solid fa-hand-holding-dollar mr-2"></i>Otorgar Nuevo Crédito</h1>
    </div>
    <form action="{{ route('creditos.store') }}" method="POST" class="p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Seleccionar Cliente</label>
            <select name="cliente_id" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">-- Seleccione un cliente --</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombres }} {{ $cliente->apellidos }} ({{ $cliente->documento_identidad }})</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Monto ($)</label>
                <input type="number" step="0.01" name="monto" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Tasa Interés (%)</label>
                <input type="number" step="0.01" name="tasa_interes" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Plazo (Meses)</label>
                <input type="number" name="plazo" min="1" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Fecha Otorgamiento</label>
                <input type="date" name="fecha_otorgamiento" value="{{ date('Y-m-d') }}" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t">
            <a href="{{ route('creditos.index') }}" class="px-4 py-2 border rounded-lg text-sm text-gray-600 hover:bg-gray-100">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 font-medium">Registrar Crédito</button>
        </div>
    </form>
</div>
@endsection