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
        Schema::create('planillaempleados', function (Blueprint $table) {
            $table->id();
            $table->float('sueldo');
            $table->float('horas_trabajadas');
            /* $table->float('horas_extras');
            $table->float('monto_horas_extras'); */
            $table->float('bono_total');
            /* $table->float('descuento_total'); */
            $table->float('afp');
            $table->float('liquido');

            $table->unsignedBigInteger('idPlanillasueldo')->nullable();
            $table->unsignedBigInteger('idEmpleado')->nullable();

            $table->foreign('idPlanillasueldo')
                ->references('id')
                ->on('planillasueldos')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('idEmpleado')
                ->references('id')
                ->on('empleados')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planillaempleados');
    }
};
