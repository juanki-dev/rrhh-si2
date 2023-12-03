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
        'Email',
        'Celular',
        'idContrato',
        'idCargo'
    ];

    public function usuario(){
        return $this->hasOne('App\Models\User','id','idUser');
    }
    public function cargo()
    {
        return $this->hasOne('App\Models\Cargo', 'id', 'idCargo');
    }
}
