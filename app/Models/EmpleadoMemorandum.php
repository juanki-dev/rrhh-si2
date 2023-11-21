<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpleadoMemorandum extends Model
{
    use HasFactory;
    protected $table = 'empleados_memorandums';

    protected $fillable = [
        'id_Empleado',
        'id_Memorandum',
    ];

    // Puedes agregar relaciones con los modelos 'Empleado' y 'Memorandum' aquí
    public function empleado()
    {
        return $this->hasOne('App\Models\Empleado', 'id', 'id_Empleado');
    }

    public function memorandum()
    {
        return $this->hasOne('App\Models\Memorandum', 'id', 'id_Memorandum');
    }
}
