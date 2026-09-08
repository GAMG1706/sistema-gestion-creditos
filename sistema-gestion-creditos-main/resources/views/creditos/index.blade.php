@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-6 bg-slate-900 text-white flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h1 class="text-xl font-bold">Gestión de Créditos</h1>
            <p class="text-xs text-slate-400">Listado general de créditos otorgados y saldos pendientes</p>
        </div>
        <a href="{{ route('creditos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm px-4 py-2 rounded-lg transition shadow">
            <i class="fa-solid fa-plus mr-1.5"></i> Nuevo Crédito
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm text-gray-600">
            <thead class="bg-gray-100 text-gray-700 uppercase font-semibold text-xs border-b">
                <tr>
                    <th class="p-4">Cliente</th>
                    <th class="p-4">Monto Base</th>
                    <th class="p-4">Total Crédito</th>
                    <th class="p-4">Saldo Pendiente</th>
                    <th class="p-4">Vencimiento</th>
                    <th class="p-4">Estado</th>
                    <th class="p-4 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($creditos as $credito)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 font-medium text-gray-900">
                        {{ $credito->cliente->nombres }} {{ $credito->cliente->apellidos }}
                    </td>
                    <td class="p-4">${{ number_format($credito->monto, 2) }}</td>
                    <td class="p-4 font-semibold text-gray-800">${{ number_format($credito->total_credito, 2) }}</td>
                    <td class="p-4 font-bold text-rose-600">${{ number_format($credito->saldo, 2) }}</td>
                    <td class="p-4">{{ \Carbon\Carbon::parse($credito->fecha_vencimiento)->format('d/m/Y') }}</td>
                    <td class="p-4">
                        @if($credito->estado == 'activo')
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">Activo</span>
                        @elseif($credito->estado == 'pagado')
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">Pagado</span>
                        @else
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-100 text-rose-800">Vencido</span>
                        @endif
                    </td>
                    <td class="p-4 text-center">
                        <a href="{{ route('creditos.show', $credito) }}" class="bg-slate-800 hover:bg-slate-700 text-white text-xs px-3 py-1.5 rounded-md font-medium transition">
                            <i class="fa-solid fa-receipt mr-1"></i> Detalle / Pagos
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-6 text-center text-gray-500">No hay créditos registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4">
        {{ $creditos->links() }}
    </div>
</div>
@endsection