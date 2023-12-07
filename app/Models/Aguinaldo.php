<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aguinaldo extends Model
{
    use HasFactory;
    protected $table = 'aguinaldos';
    protected $fillable = [
        'fecha',
        'hora',
        'dias',
        'monto',
        'estado',
        'idEmpleado',
    ];
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado', 'id');
    }
}
