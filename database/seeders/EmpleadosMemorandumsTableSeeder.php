<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpleadosMemorandumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        foreach (range(1, 10) as $index) {
            DB::table('empleados_memorandums')->insert([
                'id_Empleado' => random_int(1, 10),  // Reemplaza con el rango correcto de IDs de empleados
                'id_Memorandum' => random_int(1, 10),  // Reemplaza con el rango correcto de IDs de memorandums
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
