<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclutamiento extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'fechainicio',
        'fechafin',
        'descripcion',
        'idCargo',
    ];

    public function cargo()
    {
        return $this->hasOne('App\Models\Cargo', 'id', 'idCargo');
    }
}
