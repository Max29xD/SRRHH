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
        Schema::create('boleta_pagos', function (Blueprint $table) {
            $table->id(); // Clave primaria simple
            $table->unsignedBigInteger('empleado_id');
            $table->unsignedBigInteger('nomina_id');
            $table->integer('diasTrabajados')->nullable();
            $table->float('salario');
            $table->float('bonoAntiguedad');
            $table->float('totalGanado');
            $table->float('afp');
            $table->float('rc_iva');
            $table->float('descuentoAdicional');
            $table->float('totalDescuento')->default(0);
            $table->float('liquidoPagable');
            $table->date('fechaEmision');
            $table->boolean('estado')->default(false);//para saber si ya se pago
            $table->timestamps();

            // Definir las claves foráneas
            $table->foreign('empleado_id')
                ->references('id')
                ->on('empleados')
                ->onDelete('cascade');

            $table->foreign('nomina_id')
                ->references('id')
                ->on('nominas')
                ->onDelete('cascade');

            // Asegurar que la combinación de empleado_id y nomina_id sea única
            $table->unique(['empleado_id', 'nomina_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boleta_pagos');
    }
};
