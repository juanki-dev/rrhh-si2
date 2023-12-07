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
        Schema::create('horas_extras', function (Blueprint $table) {
            $table->id();
            $table->date('Fecha');
            $table->float('Cantidad_Hora');
            $table->float('Monto_Hora');
            $table->float('Monto_Total');
            $table->unsignedTinyInteger('estado')->default(0)->comment('0 = pendiente; 1 = pagado; 2 = anulado');;
            $table->unsignedBigInteger('idEmpleado')->nullable();
            $table->unsignedBigInteger('idContrato')->nullable();
            $table->foreign('idEmpleado')
            ->references('id')
            ->on('empleados')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->foreign('idContrato')
                ->references('id')
                ->on('Contratos')
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
        Schema::dropIfExists('horas_extras');
    }
};
