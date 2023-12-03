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
            $table->date('fecha_fin');
            $table->string('cargo');
            $table->boolean('estado')->default(true);
            $table->unsignedBigInteger('idHorario')->nullable();
            
            $table->foreign('idHorario')->references('id')
            ->on('horarios')
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
        Schema::dropIfExists('contrato');
    }
};
