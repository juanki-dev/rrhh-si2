<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //1
        DB::table('horarios')->insert([
            'hora_ini' => '08:00:00',
            'hora_fin' => '17:00:00',
        ]);
        //2 
        DB::table('horarios')->insert([
            'hora_ini' => '09:00:00',
            'hora_fin' => '18:00:00',
        ]);
        //3
        DB::table('horarios')->insert([
            'hora_ini' => '10:00:00',
            'hora_fin' => '19:00:00',
        ]);
        //4
        DB::table('horarios')->insert([
            'hora_ini' => '11:00:00',
            'hora_fin' => '20:00:00',
        ]);
        //5
        DB::table('horarios')->insert([
            'hora_ini' => '12:00:00',
            'hora_fin' => '21:00:00',
        ]);
        //6
        DB::table('horarios')->insert([
            'hora_ini' => '13:00:00',
            'hora_fin' => '22:00:00',
        ]);
        //7
        DB::table('horarios')->insert([
            'hora_ini' => '14:00:00',
            'hora_fin' => '23:00:00',
        ]);
        //8
        DB::table('horarios')->insert([
            'hora_ini' => '15:00:00',
            'hora_fin' => '00:00:00',
        ]);
        //9
        DB::table('horarios')->insert([
            'hora_ini' => '16:00:00',
            'hora_fin' => '01:00:00',
        ]);
        //10
        DB::table('horarios')->insert([
            'hora_ini' => '17:00:00',
            'hora_fin' => '02:00:00',
        ]);
        
    }
}
