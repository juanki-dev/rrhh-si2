<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planillasueldo extends Model
{
    use HasFactory;
    protected $fillable = [
        'Fecha',
        'Total_pagado',
        'Tipo',
    ];
}
