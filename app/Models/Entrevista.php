<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrevista extends Model
{
    use HasFactory;
    protected $fillable = [
        'Fechainicio',
        'Hora',
        'Calificacion',
        'Comentario',
        'idEmpleado',
        'idPostulante',
    ];

    public function empleado()
    {
        return $this->hasOne('App\Models\Empleado', 'id', 'idEmpleado');
    }

    public function postulante()
    {
        return $this->hasOne('App\Models\Postulante', 'id', 'idPostulante');
    }
}