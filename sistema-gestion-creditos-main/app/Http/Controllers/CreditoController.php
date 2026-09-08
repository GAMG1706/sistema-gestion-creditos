<?php

namespace App\Http\Controllers;

use App\Models\Credito;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CreditoController extends Controller
{
    /**
     * Muestra la lista de créditos.
     */
    public function index()
    {
        $creditos = Credito::with('cliente')->latest()->paginate(10);
        return view('creditos.index', compact('creditos'));
    }

    /**
     * Muestra el formulario para crear un nuevo crédito.
     */
    public function create()
    {
        $clientes = Cliente::where('estado', 1)->get();
        return view('creditos.create', compact('clientes'));
    }

    /**
     * Almacena un crédito en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha_otorgamiento' => 'required|date',
            'monto' => 'required|numeric|min:1',
            'tasa_interes' => 'required|numeric|min:0',
            'plazo' => 'required|integer|min:1',
        ]);

        $monto = (float) $request->monto;
        $tasa = (float) $request->tasa_interes;
        $plazo = (int) $request->plazo;

        // Cálculo del total a pagar con interés
        $total_credito = $monto + ($monto * ($tasa / 100));

        // Cálculo de fecha de vencimiento usando Carbon correctamente
        $fechaBase = Carbon::parse($request->fecha_otorgamiento);
        $fecha_vencimiento = $fechaBase->copy()->addMonths($plazo);

        Credito::create([
            'cliente_id' => $request->cliente_id,
            'fecha_otorgamiento' => $request->fecha_otorgamiento,
            'monto' => $monto,
            'tasa_interes' => $tasa,
            'plazo' => $plazo,
            'total_credito' => $total_credito,
            'saldo' => $total_credito,
            'fecha_vencimiento' => $fecha_vencimiento,
            'estado' => 'activo',
        ]);

        return redirect()->route('creditos.index')->with('success', 'Crédito registrado exitosamente.');
    }

    /**
     * Muestra el detalle de un crédito específico.
     */
    public function show(Credito $credito)
    {
        $credito->load(['cliente', 'pagos']);
        return view('creditos.show', compact('credito'));
    }

    /**
     * Muestra el formulario para editar un crédito.
     */
    public function edit(Credito $credito)
    {
        $clientes = Cliente::where('estado', 1)->get();
        return view('creditos.edit', compact('credito', 'clientes'));
    }

    /**
     * Actualiza la información del crédito.
     */
    public function update(Request $request, Credito $credito)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha_otorgamiento' => 'required|date',
            'monto' => 'required|numeric|min:1',
            'tasa_interes' => 'required|numeric|min:0',
            'plazo' => 'required|integer|min:1',
            'estado' => 'required|string',
        ]);

        $monto = (float) $request->monto;
        $tasa = (float) $request->tasa_interes;
        $plazo = (int) $request->plazo;

        $total_credito = $monto + ($monto * ($tasa / 100));

        $fechaBase = Carbon::parse($request->fecha_otorgamiento);
        $fecha_vencimiento = $fechaBase->copy()->addMonths($plazo);

        $credito->update([
            'cliente_id' => $request->cliente_id,
            'fecha_otorgamiento' => $request->fecha_otorgamiento,
            'monto' => $monto,
            'tasa_interes' => $tasa,
            'plazo' => $plazo,
            'total_credito' => $total_credito,
            'fecha_vencimiento' => $fecha_vencimiento,
            'estado' => $request->estado,
        ]);

        return redirect()->route('creditos.index')->with('success', 'Crédito actualizado correctamente.');
    }

    /**
     * Elimina un crédito de la base de datos.
     */
    public function destroy(Credito $credito)
    {
        $credito->delete();
        return redirect()->route('creditos.index')->with('success', 'Crédito eliminado correctamente.');
    }
}