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
        Schema::create('detalle_nominas', function (Blueprint $table) {
            $table->unsignedBigInteger('empleado_id');
            $table->unsignedBigInteger('nomina_id');
            $table->integer('diasTrabajados')->nullable();
            $table->float('bonoAntiguedad');
            $table->float('totalGanado');
            $table->float('afp');
            $table->float("rc_iva");
            $table->float('descuentoAdicional');
            $table->float('totalDescuento')->default(0);
            $table->float('liquidoPagable');
           
            $table->timestamps();

            $table->foreign('empleado_id')
                ->references('id')
                ->on('empleados')
                ->onDelete('cascade');

            $table->foreign('nomina_id')
                ->references('id')
                ->on('nominas')
                ->onDelete('cascade');

            $table->primary(['empleado_id', 'nomina_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_nominas');
    }
};
