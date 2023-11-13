<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacacion extends Model
{
    use HasFactory;
    protected $table = 'vacaciones'; // Asigna el nombre de la tabla
    protected $fillable = ['fecha', 'fechaInicio', 'fechaFin', 'descripcion', 'idEmpleado'];
    // Define la relación con el modelo Empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado', 'id');
    }
}
