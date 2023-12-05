<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre', 100);
            $table->string('Apellido', 100)->nullable();
            $table->string('CI')->unique();
            $table->string('Email', 100)->nullable();
            $table->string('Celular')->nullable();
            $table->string('Direccion', 100)->nullable();
            $table->date('FechaNacimiento')->nullable();
            $table->string('PaisNacimiento', 100)->nullable();
            $table->string('CiudadNacimiento', 100)->nullable();
            $table->string('Sexo',20)->nullable();
            $table->string('EstadoCivil',20)->nullable();
            $table->string('Profesion',60)->nullable();
            $table->string('Estado',20)->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
