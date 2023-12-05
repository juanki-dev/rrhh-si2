<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   //1
       DB::table('contratos')->insert([
            'sueldo' => 1000,
            'fecha_inicio' => '2021-10-21',
            'fecha_fin' => '2022-10-21',
            'tipo' => 'Temporal',
            'tipo_pago' => 'Mensual',
            'estado' => 'Activo',
            'idHorario' => 1,
            'idEmpleado' => 1,
            'idCargo' => 1,
        ]);
        //2
        DB::table('contratos')->insert([
            'sueldo' => 1000,
            'fecha_inicio' => '2021-10-21',
            'fecha_fin' => '2022-10-21',
            'tipo' => 'Temporal',
            'tipo_pago' => 'Quincenal',
            'estado' => 'Activo',
            'idHorario' => 1,
            'idEmpleado' => 2,
            'idCargo' => 2,
        ]);
        //3
        DB::table('contratos')->insert([
            'sueldo' => 1000,
            'fecha_inicio' => '2021-10-21',
            'fecha_fin' => '2022-10-21',
            'tipo' => 'Temporal',
            'tipo_pago' => 'Semanal',
            'estado' => 'Activo',
            'idHorario' => 1,
            'idEmpleado' => 3,
            'idCargo' => 3,
        ]);
        //4
        DB::table('contratos')->insert([
            'sueldo' => 1000,
            'fecha_inicio' => '2021-10-21',
            'fecha_fin' => '2022-10-21',
            'tipo' => 'Temporal',
            'tipo_pago' => 'Diario',
            'estado' => 'Activo',
            'idHorario' => 1,
            'idEmpleado' => 4,
            'idCargo' => 4,
        ]);
        //5
        DB::table('contratos')->insert([
            'sueldo' => 1000,
            'fecha_inicio' => '2021-10-21',
            'tipo' => 'Indefinido',
            'tipo_pago' => 'Hora',
            'estado' => 'Activo',
            'idHorario' => 1,
            'idEmpleado' => 5,
            'idCargo' => 5,
        ]);
        //6
        DB::table('contratos')->insert([
            'sueldo' => 1000,
            'fecha_inicio' => '2021-10-21',
            'tipo' => 'Indefinido',
            'tipo_pago' => 'Mensual',
            'estado' => 'Activo',
            'idHorario' => 1,
            'idEmpleado' => 6,
            'idCargo' => 6,
        ]);
        //7
        DB::table('contratos')->insert([
            'sueldo' => 1000,
            'fecha_inicio' => '2021-10-21',
            'tipo' => 'Indefinido',
            'tipo_pago' => 'Quincenal',
            'estado' => 'Activo',
            'idHorario' => 1,
            'idEmpleado' => 7,
            'idCargo' => 7,
        ]);
        //8
        DB::table('contratos')->insert([
            'sueldo' => 1000,
            'fecha_inicio' => '2021-10-21',
            'tipo' => 'Indefinido',
            'tipo_pago' => 'Semanal',
            'estado' => 'Activo',
            'idHorario' => 1,
            'idEmpleado' => 8,
            'idCargo' => 8,
        ]);
        //9
        DB::table('contratos')->insert([
            'sueldo' => 1000,
            'fecha_inicio' => '2021-10-21',
            'tipo' => 'Indefinido',
            'tipo_pago' => 'Diario',
            'estado' => 'Activo',
            'idHorario' => 1,
            'idEmpleado' => 9,
            'idCargo' => 9,
        ]);
        //10
        DB::table('contratos')->insert([
            'sueldo' => 1000,
            'fecha_inicio' => '2021-10-21',
            'tipo' => 'Indefinido',
            'tipo_pago' => 'Hora',
            'estado' => 'Activo',
            'idHorario' => 1,
            'idEmpleado' => 10,
            'idCargo' => 10,
        ]);
        
    }
}
