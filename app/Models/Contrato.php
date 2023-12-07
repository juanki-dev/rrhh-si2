<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;
    protected $fillable = [
        'sueldo',
        'fecha_inicio',
        'fecha_fin',
        'tipo',
        'tipo_pago',
        'estado',
        'idCargo',
        'idEmpleado',
        'idHorario',
    ];
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
