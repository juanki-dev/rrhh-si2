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
        Schema::create('empleados_memorandums', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_Empleado');
            $table->unsignedBigInteger('id_Memorandum');
            $table->foreign('id_Empleado')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('id_Memorandum')->references('id')->on('memorandums')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados_memorandums');
    }
};
