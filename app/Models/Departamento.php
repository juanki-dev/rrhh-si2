<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Departamento extends Model
{
    use HasApiTokens;
    use HasFactory;
    //use HasProfilePhoto;
    use Notifiable;
    //use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Nombre',
    ];
    public function cargo()
    {
        return $this->hasMany(Cargo::class, 'idDepartamento', 'id');
    }
}

