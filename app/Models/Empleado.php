<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'Nombre',
        'Apellido',
        'CI',
        'Email',
        'Celular',
        'Direccion',
        'FechaNacimiento',
        'PaisNacimiento',
        'CiudadNacimiento',
        'Sexo',
        'EstadoCivil',
        'Profesion',
        'Estado',
    ];

    public function usuario(){
        return $this->hasOne('App\Models\User','id','idUser');
    }
    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'idEmpleado');
    }
    public function aguinaldos()
    {
        return $this->hasMany(Aguinaldo::class, 'idEmpleado');
    }
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'idEmpleado');
    }
  
}
