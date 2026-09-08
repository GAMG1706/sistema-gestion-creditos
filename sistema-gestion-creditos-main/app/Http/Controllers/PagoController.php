<?php

namespace App\Http\Controllers;

use App\Models\Credito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagoController extends Controller
{
    public function store(Request $request, Credito $credito)
    {
        $request->validate([
            'monto' => 'required|numeric|min:0.01|max:' . $credito->saldo,
            'fecha_pago' => 'required|date',
            'referencia' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
        ], [
            'monto.max' => 'El monto a pagar no puede superar el saldo pendiente ($' . number_format($credito->saldo, 2) . ').'
        ]);

        DB::transaction(function () use ($request, $credito) {
            $credito->pagos()->create([
                'fecha_pago' => $request->fecha_pago,
                'monto' => $request->monto,
                'referencia' => $request->referencia,
                'observaciones' => $request->observaciones,
            ]);

            $credito->saldo -= $request->monto;

            if ($credito->saldo <= 0) {
                $credito->saldo = 0;
                $credito->estado = 'pagado';
            }

            $credito->save();
        });

        return redirect()->back()->with('success', 'Pago registrado correctamente.');
    }
}