<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class boletaPago extends Model
{
    use HasFactory;
    protected $fillable = [
        'empleado_id',
        'nomina_id',
        'diasTrabajados',
        'salario',
        'bonoAntiguedad',
        'totalGanado',
        'afp',
        'rc_iva',
        'descuentoAdicional',
        'totalDescuentos',
        'fechaEmision',
        'liquidoPagable',
        'estado',
    ];

    public function detalleNomina()
    {
        return $this->belongsTo(DetalleNomina::class, 'empleado_id', 'empleado_id')
            ->where('nomina_id', $this->nomina_id);
    }
}
