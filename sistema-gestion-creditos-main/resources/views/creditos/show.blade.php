@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Ficha del Crédito -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex flex-col md:flex-row justify-between border-b pb-4 mb-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600">Detalle del Crédito</span>
                <h1 class="text-2xl font-bold text-gray-800">{{ $credito->cliente->nombres }} {{ $credito->cliente->apellidos }}</h1>
                <p class="text-xs text-gray-500">Documento: {{ $credito->cliente->documento_identidad }}</p>
            </div>
            <div class="mt-4 md:mt-0 text-right">
                <span class="text-xs text-gray-400">Estado</span> <br>
                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $credito->estado == 'pagado' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                    {{ $credito->estado }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
            <div class="bg-gray-50 p-3 rounded-lg border">
                <p class="text-xs text-gray-500 uppercase">Monto Original</p>
                <p class="text-lg font-bold text-gray-800">${{ number_format($credito->monto, 2) }}</p>
            </div>
            <div class="bg-gray-50 p-3 rounded-lg border">
                <p class="text-xs text-gray-500 uppercase">Total con Interés</p>
                <p class="text-lg font-bold text-gray-800">${{ number_format($credito->total_credito, 2) }}</p>
            </div>
            <div class="bg-emerald-50 p-3 rounded-lg border border-emerald-200">
                <p class="text-xs text-emerald-600 uppercase font-medium">Total Pagado</p>
                <p class="text-lg font-bold text-emerald-700">${{ number_format($credito->total_credito - $credito->saldo, 2) }}</p>
            </div>
            <div class="bg-rose-50 p-3 rounded-lg border border-rose-200">
                <p class="text-xs text-rose-600 uppercase font-medium">Saldo Pendiente</p>
                <p class="text-lg font-bold text-rose-700">${{ number_format($credito->saldo, 2) }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Formulario de Registrar Pago -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 h-fit">
            <h2 class="text-sm font-bold uppercase text-gray-700 mb-4 border-b pb-2"><i class="fa-solid fa-money-bill-wave mr-1.5 text-emerald-600"></i> Registrar Abono</h2>
            
            @if($credito->saldo > 0)
            <form action="{{ route('pagos.store', $credito) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Monto a pagar ($)</label>
                    <input type="number" step="0.01" max="{{ $credito->saldo }}" name="monto" required class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Fecha de Pago</label>
                    <input type="date" name="fecha_pago" value="{{ date('Y-m-d') }}" required class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Referencia / Comprobante</label>
                    <input type="text" name="referencia" placeholder="Ej: VOUCHER-9842" class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Observaciones</label>
                    <textarea name="observaciones" rows="2" class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                </div>
                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-sm py-2 rounded-lg transition">
                    Procesar Pago
                </button>
            </form>
            @else
            <div class="p-4 bg-emerald-50 text-emerald-800 text-center rounded-lg text-sm font-medium">
                <i class="fa-solid fa-circle-check text-2xl mb-1 block"></i> ¡Crédito totalmente cancelado!
            </div>
            @endif
        </div>

        <!-- Historial de Pagos -->
        <div class="md:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 bg-gray-50 border-b">
                <h2 class="text-sm font-bold uppercase text-gray-700"><i class="fa-solid fa-list-check mr-1.5"></i> Historial de Pagos Realizados</h2>
            </div>
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-100 text-xs text-gray-700 uppercase border-b">
                    <tr>
                        <th class="p-3">Fecha</th>
                        <th class="p-3">Referencia</th>
                        <th class="p-3">Monto</th>
                        <th class="p-3">Observaciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($credito->pagos as $pago)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3">{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                        <td class="p-3 font-mono text-xs">{{ $pago->referencia ?? 'N/A' }}</td>
                        <td class="p-3 font-bold text-emerald-600">${{ number_format($pago->monto, 2) }}</td>
                        <td class="p-3 text-xs text-gray-500">{{ $pago->observaciones ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-6 text-center text-gray-400">No se han registrado abonos a este crédito.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection