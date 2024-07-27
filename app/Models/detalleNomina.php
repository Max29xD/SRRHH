<?php

namespace App\Models;

use App\Models\Empleado;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleNomina extends Model
{
    use HasFactory;
    protected $fillable = [
        'empleado_id',
        'nomina_id',
        //'salario',
        'diasTrabajados',
        'afp',
        'rc_iva',
        'totalGanado',
        'bonoAntiguedad',
        'totalDescuento',
        'liquidoPagable',
        'descuentoAdicional',
    ];

    public function  empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function  nomina()
    {
        return $this->belongsTo(Nomina::class);
    }

    public function boletaPago()
    {
        return $this->hasOne(BoletaPago::class, 'empleado_id', 'empleado_id')
            ->where('nomina_id', $this->nomina_id);
    }
}
