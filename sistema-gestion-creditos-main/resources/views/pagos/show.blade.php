@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-6 border">
    <div class="flex justify-between items-center border-b pb-4 mb-4">
        <div>
            <h1 class="text-xl font-bold text-gray-800">Comprobante de Pago</h1>
            <p class="text-sm text-gray-500">Recibo N°: #{{ $pago->id }}</p>
        </div>
        <span class="bg-green-100 text-green-800 font-semibold text-xs px-3 py-1 rounded-full">Procesado</span>
    </div>

    <div class="space-y-3">
        <div class="flex justify-between">
            <span class="text-gray-600 font-medium">Cliente:</span>
            <span class="font-bold text-gray-800">{{ $pago->credito->cliente->nombre }} {{ $pago->credito->cliente->apellido }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-600 font-medium">Documento / DUI:</span>
            <span>{{ $pago->credito->cliente->documento }}</span>
        </div>
        <div class="flex justify-between border-t pt-2">
            <span class="text-gray-600 font-medium">Crédito Relacionado:</span>
            <span>#{{ $pago->credito_id }}</span>
        </div>
        <div class="flex justify-between border-t pt-2">
            <span class="text-gray-600 font-medium">Monto Abonado:</span>
            <span class="text-xl font-bold text-green-600">${{ number_format($pago->monto, 2) }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-600 font-medium">Fecha y Hora:</span>
            <span>{{ \Carbon\Carbon::parse($pago->created_at)->format('d/m/Y h:i A') }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-600 font-medium">Método de Pago:</span>
            <span class="capitalize">{{ $pago->metodo_pago ?? 'Efectivo' }}</span>
        </div>
    </div>

    <div class="mt-8 pt-4 border-t flex justify-between">
        <a href="{{ route('pagos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 text-sm">
            Volver al Listado
        </a>
        <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm font-semibold">
            Imprimir Recibo
        </button>
    </div>
</div>
@endsection