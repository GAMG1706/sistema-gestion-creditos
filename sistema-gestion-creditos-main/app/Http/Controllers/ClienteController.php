<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->get('buscar');

        $clientes = Cliente::when($buscar, function ($query, $buscar) {
            return $query->where('nombres', 'like', "%{$buscar}%")
                         ->orWhere('apellidos', 'like', "%{$buscar}%")
                         ->orWhere('documento_identidad', 'like', "%{$buscar}%");
        })->latest()->paginate(10);

        return view('clientes.index', compact('clientes', 'buscar'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'documento_identidad' => 'required|string|unique:clientes',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|unique:clientes',
            'direccion' => 'required|string',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente registrado exitosamente.');
    }

    public function show(Cliente $cliente)
    {
        $cliente->load('creditos.pagos');
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'documento_identidad' => 'required|string|unique:clientes,documento_identidad,' . $cliente->id,
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|unique:clientes,correo,' . $cliente->id,
            'direccion' => 'required|string',
            'estado' => 'required|boolean',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->update(['estado' => false]);
        return redirect()->route('clientes.index')->with('success', 'Cliente desactivado correctamente.');
    }
}