<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Reclutamiento;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(DepartamentoSeeder::class);
        $this->call(HorarioSeeder::class);
        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CargoSeeder::class);
        $this->call(EmpleadoSeeder::class);
        $this->call(ContratoSeeder::class);
        $this->call(PostulanteSeeder::class);        
        $this->call(ReclutamientoSeeder::class);
        
        
    }
}
