<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bono extends Model
{
    use HasFactory;
    protected $fillable = 
    ['fecha', 'hora', 'monto', 'motivo', 'observacion', 'estado', 'idEmpleado','idPlanillasueldo'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado', 'id');
    }
    public function getFechaAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }
    public function planillasueldo()
    {
        return $this->belongsTo(Planillasueldo::class, 'idPlanillasueldo', 'id');
    }
}
