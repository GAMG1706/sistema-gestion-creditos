@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Detalle del Cliente: {{ $cliente->nombre }} {{ $cliente->apellido }}</h1>

    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <p><strong>Documento:</strong> {{ $cliente->documento }}</p>
        <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
        <p><strong>Correo:</strong> {{ $cliente->correo }}</p>
    </div>

    <h2 class="text-xl font-bold mb-3">Créditos del Cliente</h2>
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">N° Crédito</th>
                    <th class="px-4 py-2 text-left">Monto Total</th>
                    <th class="px-4 py-2 text-left">Saldo Pendiente</th>
                    <th class="px-4 py-2 text-left">Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cliente->creditos as $credito)
                    <tr>
                        <td class="px-4 py-2">#{{ $credito->id }}</td>
                        <td class="px-4 py-2">${{ number_format($credito->monto, 2) }}</td>
                        <td class="px-4 py-2">${{ number_format($credito->saldo, 2) }}</td>
                        <td class="px-4 py-2">{{ ucfirst($credito->estado) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center text-gray-500">Este cliente no tiene créditos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="{{ route('clientes.index') }}" class="text-blue-600 hover:underline">← Volver al listado</a>
    </div>
</div>
@endsection