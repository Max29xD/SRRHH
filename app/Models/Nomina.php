<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Empleado;

class Nomina extends Model
{
    use HasFactory;

    protected $fillable = [
        'empleado_id',
        'diasTrabajados',
        'bonoAntiguedad',
        'totalGanado',
        'afp',
        'estado',
        'rc_iva',
        'totalDescuento',
        'liquidoPagable',
    ];

    public function empleado(){

         return $this->hasMany(Empleado::class);
    }
}
