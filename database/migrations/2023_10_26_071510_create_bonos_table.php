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
        Schema::create('bonos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora');
            $table->decimal('monto', 8, 2);
            $table->string('motivo', 100);
            $table->string('observacion', 100);
            $table->unsignedTinyInteger('estado')->default(0)->comment('0 = pendiente; 1 = pagado; 2 = anulado');;
           
            $table->unsignedBigInteger('idEmpleado')->nullable();
            $table->unsignedBigInteger('idPlanillasueldo')->nullable();
            
            $table->foreign('idEmpleado')
            ->references('id')
            ->on('empleados')
            ->onUpdate('cascade')
            ->onDelete('set null');
            $table->foreign('idPlanillasueldo')
                ->references('id')
                ->on('planillasueldos')
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
        Schema::dropIfExists('bonos');
    }
};
