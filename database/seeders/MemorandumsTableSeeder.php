<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Faker\Factory as Faker;//Este paquete ayuda a generar datos aleatorios

class MemorandumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('memorandums')->insert([
                'subject' => $faker->sentence,
                'body' => $faker->paragraph,
                'date' => $faker->date,
                'time' => $faker->time,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
