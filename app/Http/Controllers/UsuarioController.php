<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//agregamos lo siguiente
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Spatie\Activitylog\Models\Activity;


class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:roles.index')->only('index');
        $this->middleware('can:roles.create')->only('create', 'store');
        $this->middleware('can:roles.edit')->only('edit', 'update');
        $this->middleware('can:roles.destroy')->only('destroy');
    }

    public function index(Request $request)
    {      
      

        //Con paginación
        $usuarios = User::all();
        return view('usuarios.index',compact('usuarios'));
        return view('usuarios.index', ['users'=>User::all()]);
        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $usuarios->links() !!}
    }

    
    public function create()
    {    
        $users = User::all();
        $roles = Role::all();
        return view('usuarios.crear', compact('users', 'roles'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);

        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Usuarios')->log('Registró')->subject();
        $lastActivity=Activity::all()->last();
        $lastActivity->subject_id= $user->id;
        $lastActivity->save();
    
        return redirect()->route('usuarios.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Usuarios')->log('Editó')->subject();
        $lastActivity=Activity::all()->last();
        $lastActivity->subject_id= $user->id;
        $lastActivity->save();
    
        return view('usuarios.editar',compact('user','roles'));
    }
    


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        return redirect()->route('usuarios.index');
    }


    public function destroy($id)
    {
        
        $user = User::find($id);

        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Usuarios')->log('Eliminó')->subject();
        $lastActivity=Activity::all()->last();
        $lastActivity->subject_id= $user->id;
        $lastActivity->save();

        $user->delete();

        return redirect()->route('usuarios.index');
    }
}
