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
            'sueldo' => '1000',
            'fecha_inicio' => '2021-01-01',
            'fecha_fin' => '2024-01-31',
            'cargo' => 'Gerente',
            'idHorario' => '1',
        ]);
        //2
        DB::table('contratos')->insert([
            'sueldo' => '800',
            'fecha_inicio' => '2021-02-01',
            'fecha_fin' => '2024-02-28',
            'cargo' => 'Jefe',
            'idHorario' => '2',
        ]);
        //3
        DB::table('contratos')->insert([
            'sueldo' => '600',
            'fecha_inicio' => '2021-03-01',
            'fecha_fin' => '2024-03-31',
            'cargo' => 'Asistente',
            'idHorario' => '3',
        ]);
        //4
        DB::table('contratos')->insert([
            'sueldo' => '500',
            'fecha_inicio' => '2021-04-01',
            'fecha_fin' => '2024-04-30',
            'cargo' => 'Asistente',
            'idHorario' => '4',
        ]);
        //5
        DB::table('contratos')->insert([
            'sueldo' => '400',
            'fecha_inicio' => '2021-05-01',
            'fecha_fin' => '2024-05-31',
            'cargo' => 'Asistente',
            'idHorario' => '5',
        ]);
        //6
        DB::table('contratos')->insert([
            'sueldo' => '300',
            'fecha_inicio' => '2021-06-01',
            'fecha_fin' => '2024-06-30',
            'cargo' => 'Asistente',
            'idHorario' => '6',
        ]);
        //7
        DB::table('contratos')->insert([
            'sueldo' => '200',
            'fecha_inicio' => '2021-07-01',
            'fecha_fin' => '2024-07-31',
            'cargo' => 'Asistente',
            'idHorario' => '7',
        ]);
        //8
        DB::table('contratos')->insert([
            'sueldo' => '100',
            'fecha_inicio' => '2023-08-01',
            'fecha_fin' => '2024-08-31',
            'cargo' => 'Asistente',
            'idHorario' => '8',
        ]);
        //9
        DB::table('contratos')->insert([
            'sueldo' => '1000',
            'fecha_inicio' => '2022-09-01',
            'fecha_fin' => '2024-09-30',
            'cargo' => 'Gerente',
            'idHorario' => '9',
        ]);
        //10
        DB::table('contratos')->insert([
            'sueldo' => '800',
            'fecha_inicio' => '2022-10-01',
            'fecha_fin' => '2024-10-31',
            'cargo' => 'Jefe',
            'idHorario' => '10',
        ]);
    }
}
