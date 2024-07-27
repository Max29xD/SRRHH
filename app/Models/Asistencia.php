<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'empleado_id',
        'hora_llegada',
        'hora_salida',
        'fecha',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
