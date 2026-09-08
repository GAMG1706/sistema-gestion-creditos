<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\PagoController;

Route::get('/', function () {
    return redirect()->route('clientes.index');
});

// Rutas del Módulo de Clientes
Route::resource('clientes', ClienteController::class);

// Rutas del Módulo de Créditos
Route::resource('creditos', CreditoController::class);


// Ruta para procesar el pago pasando el ID del crédito
Route::post('/creditos/{credito}/pagos', [PagoController::class, 'store'])->name('pagos.store');