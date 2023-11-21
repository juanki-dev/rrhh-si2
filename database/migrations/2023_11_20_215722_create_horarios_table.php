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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->time('HoraEntrada');
            $table->time('HoraSalida');
            $table->unsignedBigInteger('idEmpleado');
            $table->unsignedBigInteger('idCargo');
            $table->timestamps();

            $table->foreign('idEmpleado')
            ->references('id')
            ->on('empleados')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('idCargo')
            ->references('id')
            ->on('cargos')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
