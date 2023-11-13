<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Livewire\on;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('postulantesreclutamientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPostulante');
            $table->unsignedBigInteger('idReclutamiento');

            $table->foreign('idPostulante')->references('id')->on('postulantes')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('idReclutamiento')->references('id')->on('reclutamientos')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulantesreclutamiento');
    }
};
