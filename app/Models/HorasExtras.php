<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorasExtras extends Model
{
    use HasFactory;
    protected $fillable = [
        'Fecha',
        'Cantidad_Hora',
        'Monto_Hora',
        'Monto_Total',
        'estado',
        'idEmpleado',
        'idContrato',
    ];

    // Relación con el modelo Contrato
    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'idContrato');
    }

    // Relación con el modelo Empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado');
    }
}
