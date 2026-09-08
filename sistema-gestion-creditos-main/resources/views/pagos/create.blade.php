@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md mt-6 border">
    <h2 class="text-xl font-bold mb-4 text-gray-800">Registrar Pago para Crédito #{{ $credito->id }}</h2>
    <p class="text-sm text-gray-600 mb-4">
        Cliente: <strong>{{ $credito->cliente->nombre }} {{ $credito->cliente->apellido }}</strong> | 
        Saldo Pendiente: <span class="text-red-600 font-bold">${{ number_format($credito->saldo, 2) }}</span>
    </p>

    <form action="{{ route('pagos.store', $credito->id) }}" method="POST">
        @csrf

        {{-- Monto --}}
        <div class="mb-4">
            <label for="monto" class="block text-gray-700 font-medium mb-1">Monto a Pagar ($)</label>
            <input type="number" step="0.01" name="monto" id="monto" max="{{ $credito->saldo }}" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" placeholder="0.00" value="{{ old('monto') }}" required>
            @error('monto') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        {{-- Fecha de Pago --}}
        <div class="mb-4">
            <label for="fecha_pago" class="block text-gray-700 font-medium mb-1">Fecha de Pago</label>
            <input type="date" name="fecha_pago" id="fecha_pago" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" value="{{ old('fecha_pago', date('Y-m-d')) }}" required>
            @error('fecha_pago') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        {{-- Referencia / N° Transacción --}}
        <div class="mb-4">
            <label for="referencia" class="block text-gray-700 font-medium mb-1">Referencia / N° Recibo (Opcional)</label>
            <input type="text" name="referencia" id="referencia" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" placeholder="Ej. REF-12345" value="{{ old('referencia') }}">
            @error('referencia') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        {{-- Observaciones --}}
        <div class="mb-6">
            <label for="observaciones" class="block text-gray-700 font-medium mb-1">Observaciones (Opcional)</label>
            <textarea name="observaciones" id="observaciones" rows="3" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" placeholder="Comentarios sobre el pago...">{{ old('observaciones') }}</textarea>
            @error('observaciones') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('creditos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 font-semibold">Guardar Pago</button>
        </div>
    </form>
</div>
@endsection