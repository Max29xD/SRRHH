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
        Schema::create('datos_laborales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empleado_id');
            $table->float('salario');
            $table->string('puesto', 50);
            $table->date('fechaContratacion');
            $table->date('fechaSalida')->nullable();
            $table->text('trabajosAnteriores')->nullable();
            $table->timestamps();

            $table->foreign('empleado_id')
                ->references('id')->on('empleados')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_laborales');
    }
};
