<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\MemorandumController;

use App\Http\Controllers\BonoController;
use App\Http\Controllers\DescuentoController;
use App\Http\Controllers\VacacionController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\PostulanteReclutamientoController;
use App\Http\Controllers\ReclutamientoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PostulanteController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EntrevistaController;
use App\Http\Controllers\HorarioController;
use App\Models\Descuento;

Route::get('/', function () {
    return view('welcome');
});




Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

//y creamos un grupo de rutas protegidas para los controladores
Route::group(['middleware' => ['auth']], function () {

    Route::resource('usuarios', UsuarioController::class);
    Route::resource('empleados', EmpleadoController::class);
    Route::resource('postulantes', PostulanteController::class);
    Route::resource('cargos', CargoController::class);
    Route::resource('departamentos', DepartamentoController::class);
    Route::resource('bitacora', BitacoraController::class)->names('bitacora');
    Route::resource('roles', RoleController::class);
    
    Route::get('memorandums/empleados', [MemorandumController::class, 'indexEmpleado'])->name('memorandum.indexEmpleado');
    Route::get('memorandums/empleados/ver/{id}', [MemorandumController::class, 'showEmpleado'])->name('memorandum.verEmpleado');
    Route::get('memorandums/create/{id}', [MemorandumController::class, 'create'])->name('memorandum.create');
    Route::resource('memorandums', MemorandumController::class);

    Route::get('bonos/empleados', [BonoController::class, 'indexEmpleado'])->name('bono.indexEmpleado');
    Route::get('bonos/empleados/ver/{id}', [BonoController::class, 'showEmpleado'])->name('bono.verEmpleado');
    Route::get('bonos/create/{id}', [BonoController::class, 'create'])->name('bono.create');
    Route::resource('bonos', BonoController::class);

    Route::get('descuentos/empleados', [DescuentoController::class, 'indexEmpleado'])->name('descuento.indexEmpleado');
    Route::get('descuentos/empleados/ver/{id}', [DescuentoController::class, 'showEmpleado'])->name('descuento.verEmpleado');
    Route::get('descuentos/create/{id}', [DescuentoController::class, 'create'])->name('descuento.create');
    Route::resource('descuentos', DescuentoController::class);


    Route::get('vacaciones/empleados', [VacacionController::class, 'indexEmpleado'])->name('vacacion.indexEmpleado'); 
    Route::get('vacaciones/empleados/ver/{id}', [VacacionController::class, 'showEmpleado'])->name('vacacion.verEmpleado');
    Route::get('vacaciones/create/{id}', [VacacionController::class, 'create'])->name('vacacion.create');
    Route::resource('vacaciones', VacacionController::class);

    Route::get('reclutamientos/assign/{id}', [ReclutamientoController::class, 'assign'])->name('reclutamientos.assign');
    Route::get('postulantereclutamiento/store/{idpostulante}/{idreclutamiento}',[PostulanteReclutamientoController::class, 'store2'])->name('postulantereclutamientos.store');
    Route::resource('reclutamientos', ReclutamientoController::class);
    
    Route::get('permisos/empleados', [PermisoController::class, 'indexEmpleado'])->name('permiso.indexEmpleado'); 
    Route::get('permisos/empleados/ver/{id}', [PermisoController::class, 'showEmpleado'])->name('permiso.verEmpleado');
    Route::get('permisos/create/{id}', [PermisoController::class, 'create'])->name('permiso.create');
    Route::resource('permisos', PermisoController::class);

    Route::resource('entrevistas', EntrevistaController::class);
    Route::resource('horarios', HorarioController::class);

    //para los pdfs aqui iran las rutas
    Route::get('/empleados/{empleado}/download-pdf', [EmpleadoController::class, 'downloadPDF'])->name('empleados.pdf');
    Route::get('/postulantes/{postulante}/download-pdf', [PostulanteController::class, 'downloadPDF'])->name('postulantes.pdf');

    Route::post('/backup', [BackupController::class, 'create'])->name('backup.create');
    Route::get('/backup/download/{fileName}', [BackupController::class, 'download'])->name('backup.download');
    Route::post('/backup/restore-database', [BackupController::class, 'restoreDatabase'])->name('backup.restoreDatabase');
});
