<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombres',
        'apellidos',
        'documento_identidad',
        'telefono',
        'correo',
        'direccion',
        'estado',
    ];

    public function creditos()
    {
        return $this->hasMany(Credito::class);
    }
}