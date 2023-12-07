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
        Schema::create('aguinaldos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora');
            $table->unsignedBigInteger('dias');//Dias que ha estado contratado
            $table->decimal('monto', 8, 2);
            $table->unsignedTinyInteger('estado')->default(0)->comment('0 = pendiente; 1 = pagado; 2 = anulado');//aunque anulado no se usa
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
        Schema::dropIfExists('aguinaldos');
    }
};
