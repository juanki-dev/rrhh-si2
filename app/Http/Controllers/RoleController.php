<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:roles.index')->only('index');
        $this->middleware('can:roles.create')->only('create', 'store');
        $this->middleware('can:roles.edit')->only('edit', 'update');
        $this->middleware('can:roles.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $role=Role::all();
        return view('rol.index', ['roles' => Role::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('rol.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {    // Validar que los permisos proporcionados existan en la base de datos
        $validPermissions = Permission::whereIn('name', $request->permissions)->pluck('name');

        if (count($request->permissions) !== count($validPermissions)) {
            // Al menos uno de los permisos proporcionados no es válido
            return view("rol.message", ['msg' => "Permisos inválidos"]);
        }

        $role = Role::create($request->all());
        $role->syncPermissions($validPermissions);  // Asignar solo permisos válidos
        return view("rol.message", ['msg' => "Guardado con Éxito"]);

        /*
        $role=Role::create($request->all());
        $role->syncPermissions($request->permissions);
        return view("rol.message",['msg'=>"Guardado con Exito"]);
       //-----------------------------------
        activity()->useLog('Rol')->log('Nuevo')->subject();
        $lastActivity = Activity::all()->last();
        $lastActivity->subject_id = Role::all()->last()->id;
        $lastActivity->save();

        return redirect()->route('roles.index')->with('info', 'El rol se creó con exito');
       */
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('rol.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        /* $permissions = Permission::all();
        return view('rol.edit', compact('role', 'permissions'));*/
        $role = Role::find($id);
        $permissions = Permission::all();
        return view('rol.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        // Validar que los permisos proporcionados existan en la base de datos
        $validPermissions = Permission::whereIn('name', $request->permissions)->pluck('name');

      /*if (count($request->permissions) != count($validPermissions)) {
            // Al menos uno de los permisos proporcionados no es válido
            return view("rol.message", ['msg' => "Permisos inválidos"]);
        }*/

        // Actualizar el rol con los permisos válidos
        $role->update($request->all());
        $role->syncPermissions($validPermissions);  // Asignar solo permisos válidos

        activity()->useLog('Rol')->log('Editado')->subject();
        $lastActivity = Activity::all()->last();
        $lastActivity->subject_id = $role->id;  // Usar el ID del rol actualizado
        $lastActivity->save();

        return redirect()->route('roles.index')->with('info', 'El rol se actualizó con éxito');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('info', 'El rol se eliminó con exito');
    }
}
