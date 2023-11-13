<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {/*
        $guardName = 'web'; // Reemplaza 'web' con el nombre de tu guardia si es diferente.

        if (!Role::where('name', 'Administrador')->where('guard_name', $guardName)->exists()) {
            Role::create([
                'name' => 'Administrador',
                'guard_name' => $guardName,
            ]);
        }
            */
        //aqui creamos loa Roles
        //---------------Asignacion de Roles
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Empleado']);
        //-----------------Asignacion de Permisos
        Permission::create([
            'name' => 'users.index',
            'description' => 'Ver Listado de usuarios'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'users.create',
            'description' => 'Crear usuarios'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'users.edit',
            'description' => 'Editar usuario'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'users.destroy',
            'description' => 'Eliminar usuario'
        ])->syncRoles([$role1]);
        //-----------------Mostrar Roles
        Permission::create([
            'name' => 'roles.index',
            'description' => 'Ver listado de roles'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'roles.create',
            'description' => 'Crear rol'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'roles.edit',
            'description' => 'Editar rol'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'roles.destroy',
            'description' => 'Eliminar rol'
        ])->syncRoles([$role1]);
        //---------------Empleado
        Permission::create([
            'name' => 'empleados.index',
            'description' => 'Ver Listado de Empleados'
        ])->syncRoles([$role1,$role2]);
        Permission::create([
            'name' => 'empleados.crear',
            'description' => 'Crear Empleados'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'empleados.editar',
            'description' => 'Editar Empleados'
        ])->syncRoles([$role1]);
         //---------------Postulante
         Permission::create([
            'name' => 'postulantes.index',
            'description' => 'Ver Listado de Postulantes'
        ])->syncRoles([$role1,$role2]);
        Permission::create([
            'name' => 'postulantes.crear',
            'description' => 'Crear Postulantes'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'postulantes.editar',
            'description' => 'Editar Postulantes'
        ])->syncRoles([$role1]);
        //---------------Departamento
        Permission::create([
            'name' => 'departamentos.index',
            'description' => 'Ver Listado de Departamentos'
        ])->syncRoles([$role1,$role2]);
        Permission::create([
            'name' => 'departamentos.crear',
            'description' => 'Crear Departamentos'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'departamentos.editar',
            'description' => 'Editar Departamentos'
        ])->syncRoles([$role1]);
        //---------------Cargo
        Permission::create([
            'name' => 'cargos.index',
            'description' => 'Ver Listado de Cargos'
        ])->syncRoles([$role1,$role2]);
        Permission::create([
            'name' => 'cargos.crear',
            'description' => 'Crear Cargos'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'cargos.editar',
            'description' => 'Editar Cargos'
        ])->syncRoles([$role1]);

         //---------------Bitacora
         Permission::create([
            'name' => 'bitacora.index',
            'description' => 'Ver Bitacora'
        ])->syncRoles([$role1]);

          //---------------Bonos
        Permission::create([
            'name' => 'bonos.index',
            'description' => 'Ver Listado de Bonos'
        ])->syncRoles([$role1,$role2]);
        Permission::create([
            'name' => 'bonos.crear',
            'description' => 'Crear Bonos'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'bonos.editar',
            'description' => 'Editar Bonos'
        ])->syncRoles([$role1]);
        
        Permission::create([
            'name' => 'bonos.show',
            'description' => 'Ver Detalles de Bonos'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'indexEmpleado.show',
            'description' => 'Asignar Bonos'
        ])->syncRoles([$role1]);
        //---------------Vacaciones
        Permission::create([
            'name' => 'vacaciones.index',
            'description' => 'Ver Listado de Vacaciones'
        ])->syncRoles([$role1,$role2]);
        Permission::create([
            'name' => 'vacaciones.crear',
            'description' => 'Crear Vacaciones'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'vacaciones.editar',
            'description' => 'Editar Vacaciones'
        ])->syncRoles([$role1]);
        
        
    }
}
