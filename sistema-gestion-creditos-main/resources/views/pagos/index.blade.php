@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Historial de Pagos y Abonos</h1>
        <a href="{{ route('pagos.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow">
            + Registrar Nuevo Pago
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">N° Recibo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cliente</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">N° Crédito</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Monto Abonado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($pagos as $pago)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">#{{ $pago->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $pago->credito->cliente->nombre }} {{ $pago->credito->cliente->apellido }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            Crédito #{{ $pago->credito_id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-600">
                            ${{ number_format($pago->monto, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($pago->created_at)->format('d/m/Y h:i A') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <a href="{{ route('pagos.show', $pago->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">Ver Recibo</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No se han registrado pagos en el sistema.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $pagos->links() }}
    </div>
</div>
@endsection