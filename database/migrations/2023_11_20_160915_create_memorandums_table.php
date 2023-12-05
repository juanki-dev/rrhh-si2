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
        Schema::create('memorandums', function (Blueprint $table) {
            
            $table->id();
            $table->string('asunto', 70);
            $table->text('contenido');
            $table->date('fecha');
            $table->time('hora');
            $table->unsignedBigInteger('idEmpleado');

            $table->foreign('idEmpleado')
            ->references('id')
            ->on('empleados')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memorandums');
    }
};
