<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;


class BackupController extends Controller
{
    public function download($fileName)
    {
        $filePath = storage_path('app/Laravel/' . $fileName);

        if (Storage::exists('Laravel/' . $fileName)) {
            return response()->download($filePath);
        } else {
            return back()->with('error', 'El archivo de respaldo solicitado no existe');
        }
    }

    public function create()
    {
        try {
            // Ejecutar el comando de respaldo de Laravel
            Artisan::call('backup:run');
            
            return back()->with('success', 'Respaldo creado con éxito');
        } catch (\Exception $e) {
            return back()->with('error', 'Hubo un error al crear el respaldo: ' . $e->getMessage());
        }
    }

    public function restoreDatabase(Request $request)
    {
        try {
            // Obtén el nombre del archivo de respaldo de la base de datos a restaurar
            $databaseFileName = $request->input('database_backup_file');

            // Ejecuta el comando de restauración de la base de datos de Laravel Backup
            Artisan::call('backup:run', [
                '--only-db' => true, // Restaurar solo la base de datos
                '--disable-notifications' => true, // Desactivar notificaciones durante la restauración
                '--filename' => $databaseFileName // Especificar el nombre del archivo de respaldo de la base de datos a restaurar
            ]);

            return back()->with('success', 'Restauración de la base de datos realizada con éxito');
        } catch (\Exception $e) {
            return back()->with('error', 'Hubo un error al restaurar la base de datos: ' . $e->getMessage());
        }
    }

}

