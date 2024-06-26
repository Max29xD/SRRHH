<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [//   
        'nombreCompleto',
        'ci',
        'telefono',
        'fechaNacimiento',
        'email',
        'direccion',
        
    ];
    //las clave foranea las tienen el hijo que apunta al padre

    public function datosLaborales()
    {
        return $this->hasOne(DatosLaborales::class);
    }

    public function contactosEmergencia()
    {
        return $this->hasOne(ContactosEmergencia::class);
    }

    public function historial()//creo que deberia de ser hasOne
    {
        return $this->hasMany(Historial::class);
    }
    
    public function asistencias(){
        return $this->hasMany(Asistencia::class);
    }

    public function licencias(){
        return $this->hasMany(Licencia::class);
    }

    public function nominas(){//un empleado pertenece a una nomina
        return $this->belongsTo(Nomina::class);
    }
}
