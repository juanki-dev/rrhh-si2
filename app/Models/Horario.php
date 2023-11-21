<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $fillable = [
        'HoraEntrada',
        'HoraSalida',
        'idEmpleado',
        'idCargo',
    ];

    public function empleado()
    {
        return $this->hasOne('App\Models\Empleado', 'id', 'idEmpleado');
    }

    public function cargo()
    {
        return $this->hasOne('App\Models\Cargo', 'id', 'idCargo');
    }
}