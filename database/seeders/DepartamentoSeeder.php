<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   //1
        DB::table('departamentos')->insert([
            'Nombre' => 'Recursos Humanos',
        ]);
        //2
        DB::table('departamentos')->insert([
            'Nombre' => 'Finanzas',
        ]);
        //3
        DB::table('departamentos')->insert([
            'Nombre' => 'Producción',
        ]);
        //4
        DB::table('departamentos')->insert([
            'Nombre' => 'Ventas',
        ]);
        //5
        DB::table('departamentos')->insert([
            'Nombre' => 'Marketing',
        ]);
        //6
        DB::table('departamentos')->insert([
            'Nombre' => 'Sistemas',
        ]);
        //7
        DB::table('departamentos')->insert([
            'Nombre' => 'Compras',
        ]);
        //8
        DB::table('departamentos')->insert([
            'Nombre' => 'Logística',
        ]);
        //9
        DB::table('departamentos')->insert([
            'Nombre' => 'Contabilidad',
        ]);
        //10
        DB::table('departamentos')->insert([
            'Nombre' => 'Administración',
        ]);
        //11
        DB::table('departamentos')->insert([
            'Nombre' => 'Almacén',
        ]);
        //12
        DB::table('departamentos')->insert([
            'Nombre' => 'Mantenimiento',
        ]);
        //13
        DB::table('departamentos')->insert([
            'Nombre' => 'Calidad',
        ]);
        //14
        DB::table('departamentos')->insert([
            'Nombre' => 'Seguridad',
        ]);
        //15
        DB::table('departamentos')->insert([
            'Nombre' => 'Servicio al Cliente',
        ]);
        //16
        DB::table('departamentos')->insert([
            'Nombre' => 'Investigación y Desarrollo',
        ]);
        //17
        DB::table('departamentos')->insert([
            'Nombre' => 'Legal',
        ]);
        //18
        DB::table('departamentos')->insert([
            'Nombre' => 'Gerencia General',
        ]);
        
    }
}
