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
        Schema::create('reclutamientos', function (Blueprint $table) {
            $table->id();
            $table->date('fechainicio');
            $table->date('fechafin');
            $table->string('descripcion');
            $table->unsignedBigInteger('idCargo')->nullable();

            $table->foreign('idCargo')->references('id')
            ->on('cargos')
            ->onDelete('cascade')
            ->onupdate('cascade')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reclutamientos');
    }
};