<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\DateTime;

class ReclutamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //1
        DB::table('reclutamientos')->insert([
            'nombre' => 'Reclutamiento Director financiero',
            'fechainicio' =>'2021-10-01',
            'fechafin' => '2021-10-11',
            'descripcion' => 'Se busca encargado de la gestión financiera de la empresa',
            'idCargo' => '1',
        ]);

        //2
        DB::table('reclutamientos')->insert([
            'nombre' => 'Reclutamiento Gerente de Producción',
            'fechainicio' => '2022-09-01',
            'fechafin' => '2022-09-22',
            'descripcion' => 'Se solicita personal para que supervise la producción y operaciones de la empresa',
            'idCargo' => '2',
        ]);

        //3
        DB::table('reclutamientos')->insert([
            'nombre' => 'Reclutamiento Coordinador de Ventas',
            'fechainicio' => '2023-10-01',
            'fechafin' => '2023-10-10',
            'descripcion' => 'Se necesita personal para que coordine las actividades del equipo de ventas',
            'idCargo' => '3',
        ]);
    }
}
