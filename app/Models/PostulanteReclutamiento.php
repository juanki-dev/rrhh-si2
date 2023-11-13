<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostulanteReclutamiento extends Model
{
    use HasFactory;
    protected $table = 'postulantesreclutamientos';

    protected $fillable = [
        'idPostulante',
        'idReclutamiento'
    ];
    public function postulante()
    {
        return $this->hasOne('App\Models\Postulante', 'id', 'idPostulante');
    }
    public function reclutamiento()
    {
        return $this->hasOne('App\Models\Reclutamiento', 'id', 'idReclutamiento');
    }
}
