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
        Schema::create('entrevistas', function (Blueprint $table) {
            $table->id();
            $table->date('Fechainicio');
            $table->time('Hora');
            $table->integer('Calificacion');
            $table->string('Comentario', 200);
            $table->unsignedBigInteger('idEmpleado');
            $table->unsignedBigInteger('idPostulante');
            $table->timestamps();


            $table->foreign('idEmpleado')
            ->references('id')
            ->on('empleados')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('idPostulante')
            ->references('id')
            ->on('postulantes')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entrevistas');
    }
};
