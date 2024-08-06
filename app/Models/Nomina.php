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
        'fecha',
        'estado',
    ];

    public function detalleNomina(){

         return $this->hasMany(detalleNomina::class);
    }
}
