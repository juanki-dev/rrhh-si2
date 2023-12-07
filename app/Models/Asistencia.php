<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencias'; // Especifica el nombre de la tabla si es diferente al convencional

    protected $fillable = [
        'fecha',
        'hora_entrada',
        'hora_salida',
        'idEmpleado',
    ];

    // Relación con la tabla 'empleados'
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado');
    }
}
