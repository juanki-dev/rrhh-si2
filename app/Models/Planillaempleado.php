<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planillaempleado extends Model
{
    use HasFactory;
    protected $fillable = [
        'sueldo',
        'horas_trabajadas',
        'bono_total',
        'afp',
        'liquido',
        'idEmpleado',
        'idPlanillasueldo',
        /* 'horas_extras',
        'monto_horas_extras',
        'descuento_total', */
    ];
}
