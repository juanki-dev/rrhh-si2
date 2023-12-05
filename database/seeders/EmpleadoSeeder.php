<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Empleado 1
        DB::table('empleados')->insert([
            'Nombre' => 'Juan',
            'Apellido' => 'Pérez',
            'CI' => '1234567',
            'Email' => 'juan.perez@example.com',
            'Celular' => '71112233',
            'Direccion' => 'Av. 6 de Agosto #231',
            'FechaNacimiento' => '1990-01-01',
            'PaisNacimiento' => 'Bolivia',
            'CiudadNacimiento' => 'La Paz',
            'Sexo' => 'Masculino',
            'EstadoCivil' => 'Soltero',
            'Profesion' => 'Ingeniero de Sistemas',
            'Estado' => 'Activo',
        ]);
        //2
        DB::table('empleados')->insert([
            'Nombre' => 'Maria',
            'Apellido' => 'Gonzales',
            'CI' => '1234568',
            'Email' => 'maria.gonzales@example.com',
            'Celular' => '71112234',
            'Direccion' => 'Av. Cañoto #452',
            'FechaNacimiento' => '1990-01-01',
            'PaisNacimiento' => 'Bolivia',
            'CiudadNacimiento' => 'Santa Cruz',
            'Sexo' => 'Femenino',
            'EstadoCivil' => 'Soltero',
            'Profesion' => 'Ingeniero de Sistemas',
            'Estado' => 'Activo',
        ]);
        //3
        DB::table('empleados')->insert([
            'Nombre' => 'Pedro',
            'Apellido' => 'Mamani',
            'CI' => '1234569',
            'Email' => 'pedro.mamani',
            'Celular' => '71112235',
            'Direccion' => 'Av. 6 de Agosto #231',
            'FechaNacimiento' => '1990-01-01',
            'PaisNacimiento' => 'Bolivia',
            'CiudadNacimiento' => 'Santa Cruz',
            'Sexo' => 'Masculino',
            'EstadoCivil' => 'Soltero',
            'Profesion' => 'Ingeniero de Sistemas',
            'Estado' => 'Activo',
        ]);
        //4
        DB::table('empleados')->insert([
            'Nombre' => 'Andrés',
            'Apellido' => 'López',
            'CI' => '1239567',
            'Email' => 'andres.lopez@example.com',
            'Celular' => '71112233',
            'Direccion' => 'Av. 6 de Agosto #231',
            'FechaNacimiento' => '1990-01-01',
            'PaisNacimiento' => 'Bolivia',
            'CiudadNacimiento' => 'La Paz',
            'Sexo' => 'Masculino',
            'EstadoCivil' => 'Soltero',
            'Profesion' => 'Ingeniero de Sistemas',
            'Estado' => 'Activo',
        ]);
        //5
        DB::table('empleados')->insert([
            'Nombre' => 'Carlos',
            'Apellido' => 'García',
            'CI' => '1234570',
            'Email' => 'carlos.garcia@example.com',
            'Celular' => '71112236',
            'Direccion' => 'Av. 6 de Agosto #231',
            'FechaNacimiento' => '1990-01-01',
            'PaisNacimiento' => 'Bolivia',
            'CiudadNacimiento' => 'La Paz',
            'Sexo' => 'Masculino',
            'EstadoCivil' => 'Soltero',
            'Profesion' => 'Ingeniero de Sistemas',
            'Estado' => 'Activo',
        ]);
        //6
        DB::table('empleados')->insert([
            'Nombre' => 'Laura',
            'Apellido' => 'López',
            'CI' => '1234571',
            'Email' => 'laura.lopez@example.com',
            'Celular' => '71112237',
            'Direccion' => 'Av. Cañoto #452',
            'FechaNacimiento' => '1990-01-01',
            'PaisNacimiento' => 'Bolivia',
            'CiudadNacimiento' => 'Santa Cruz',
            'Sexo' => 'Femenino',
            'EstadoCivil' => 'Soltero',
            'Profesion' => 'Ingeniero de Sistemas',
            'Estado' => 'Activo',
        ]);
        //7
        DB::table('empleados')->insert([
            'Nombre' => 'Fernando',
            'Apellido' => 'Martínez',
            'CI' => '1234572',
            'Email' => 'fernando.martinez@example.com',
            'Celular' => '71112238',
            'Direccion' => 'Av. 6 de Agosto #231',
            'FechaNacimiento' => '1990-01-01',
            'PaisNacimiento' => 'Bolivia',
            'CiudadNacimiento' => 'Santa Cruz',
            'Sexo' => 'Masculino',
            'EstadoCivil' => 'Soltero',
            'Profesion' => 'Ingeniero de Sistemas',
            'Estado' => 'Activo',
        ]);
        //8
        DB::table('empleados')->insert([
            'Nombre' => 'Ana',
            'Apellido' => 'Gómez',
            'CI' => '1234573',
            'Email' => 'ana.gomez@example.com',
            'Celular' => '71112239',
            'Direccion' => 'Av. 6 de Agosto #231',
            'FechaNacimiento' => '1990-01-01',
            'PaisNacimiento' => 'Bolivia',
            'CiudadNacimiento' => 'La Paz',
            'Sexo' => 'Femenino',
            'EstadoCivil' => 'Soltero',
            'Profesion' => 'Ingeniero de Sistemas',
            'Estado' => 'Activo',
        ]);
        //9
        DB::table('empleados')->insert([
            'Nombre' => 'Jorge',
            'Apellido' => 'Rodríguez',
            'CI' => '1234574',
            'Email' => 'jorge.rodriguez@example.com',
            'Celular' => '71112240',
            'Direccion' => 'Av. Cañoto #452',
            'FechaNacimiento' => '1990-01-01',
            'PaisNacimiento' => 'Bolivia',
            'CiudadNacimiento' => 'Santa Cruz',
            'Sexo' => 'Masculino',
            'EstadoCivil' => 'Soltero',
            'Profesion' => 'Ingeniero de Sistemas',
            'Estado' => 'Activo',
        ]);
        //10
        DB::table('empleados')->insert([
            'Nombre' => 'María',
            'Apellido' => 'López',
            'CI' => '1234575',
            'Email' => 'maria.lopez@example.com',
            'Celular' => '71112241',
            'Direccion' => 'Av. 6 de Agosto #231',
            'FechaNacimiento' => '1991-02-02',
            'PaisNacimiento' => 'Bolivia',
            'CiudadNacimiento' => 'La Paz',
            'Sexo' => 'Femenino',
            'EstadoCivil' => 'Soltero',
            'Profesion' => 'Ingeniero de Sistemas',
            'Estado' => 'Activo',
        ]);
    }
}
