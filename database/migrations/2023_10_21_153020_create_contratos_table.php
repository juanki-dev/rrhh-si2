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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->float('sueldo');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->string('tipo');
            $table->string('tipo_pago');
            $table->string('estado');
            $table->unsignedBigInteger('idHorario')->nullable();
            $table->unsignedBigInteger('idEmpleado')->nullable();
            $table->unsignedBigInteger('idCargo')->nullable();

            $table->foreign('idHorario')->references('id')
            ->on('horarios')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->foreign('idEmpleado')->references('id')
            ->on('empleados')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->foreign('idCargo')->references('id')
            ->on('cargos')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrato');
    }
};
