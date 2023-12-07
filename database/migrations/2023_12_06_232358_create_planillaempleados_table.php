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
            $table->float('sueldo')->nullable();
            $table->float('horas_trabajadas')->nullable();
            $table->float('horas_extras')->nullable();
            $table->float('monto_horas_extras')->nullable();
            $table->float('bono_total')->nullable();
            $table->float('descuento_total')->nullable();
            $table->float('afp')->nullable();
            $table->float('liquido')->nullable();

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
