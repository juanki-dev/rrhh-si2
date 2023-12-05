<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Faker\Factory as Faker;//Este paquete ayuda a generar datos aleatorios
use App\Models\Empleado;    

class MemorandumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            // Obtener un id de empleado existente
            $idEmpleado = Empleado::inRandomOrder()->first()->id;

            DB::table('memorandums')->insert([
                'asunto' => $faker->sentence,
                'contenido' => $faker->paragraph,
                'fecha' => $faker->date,
                'hora' => $faker->time,
                'idEmpleado' => $idEmpleado, // Asignar un id de empleado existente

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
