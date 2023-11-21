<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'fechaInicio',
        'fechaFin',
        'motivo',
        'idEmpleado',
    ];

    // Relación con el modelo Empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado');
    }
}
