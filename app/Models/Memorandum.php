<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memorandum extends Model
{
    use HasFactory;
    protected $table = 'memorandums';
    protected $fillable = [
        'asunto',
        'contenido',
        'fecha',
        'hora',
        'idEmpleado',
    ];
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado', 'id');
    }
}
