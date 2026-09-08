<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'fecha_otorgamiento',
        'monto',
        'tasa_interes',
        'plazo',
        'total_credito',
        'saldo',
        'fecha_vencimiento',
        'estado',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}