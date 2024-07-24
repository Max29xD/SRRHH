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
        Schema::create('nominas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empleado_id');
            $table->timestamp('fecha');
            $table->integer('diasTrabajados');
            $table->float('bonoAntiguedad');
            $table->float('totalGanado');
            $table->float('afp');
            $table->boolean('estado')->default(false); // false indica no pagado
            $table->float('totalDescuento')->default(0);
            $table->float('liquidoPagable');
            $table->float("rc_iva");
            $table->timestamps();
            
            $table->foreign('empleado_id')
                ->references('id')
                ->on('empleados')
                ->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nominas');
    }
};
