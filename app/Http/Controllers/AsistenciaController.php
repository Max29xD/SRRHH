<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\Empleado;
use Carbon\Carbon;

class AsistenciaController extends Controller
{
    public function create()
    {
        return view('asistencias.create');
    }

    public function registrarLlegada(Request $request)
    {
        $empleado = Empleado::where('ci', $request->ci)->firstOrFail();//devuelve el primer registro que coinciada
        //$diasTrabajados = $empleado->asistencias()->count();//cuenta los registros de asistencia que tiene falta corregir

        Asistencia::create([
            'empleado_id' => $empleado->id,//para que empleado es la asistencia
            'hora_llegada' => Carbon::now()->format('H:i:s'), 
        ]);

        return redirect()->route('asistencias.create')
        ->with('success', 'Llegada registrada exitosamente.');
    }

    public function registrarSalida(Request $request)
    {
        $empleado = Empleado::where('ci', $request->ci)->firstOrFail();
        
        $asistencia = Asistencia::where('empleado_id', $empleado->id)
                                ->whereNull('hora_salida')//filtra las que no tiene hora de salida
                                ->orderBy('hora_llegada', 'desc')
                                ->firstOrFail();

        $asistencia->update([
            'hora_salida' => Carbon::now(),
        ]);

        return redirect()->route('asistencias.create')->with('success', 'Hora de salida registrada correctamente.');
    }

    public function index(Request $request)
    {
        // Obtiene las asistencias con la relación al empleado, aplicando filtros condicionales
        $asistencias = Asistencia::with('empleado') //asistencias es la variable que le pasamos en compact
        
                        ->when($request->filled('ci'), function($query) use ($request) {//aplica el filtro si el campo ci no esta vacio en la solicitud
                            $query->whereHas('empleado', function($query) use ($request) {
                                $query->where('ci', $request->ci);
                            });
                        })

                        ->when($request->filled('fecha'), function($query) use ($request) {
                            // Convertimos la fecha del request al formato 'Y-m-d'
                            $fecha = Carbon::createFromFormat('Y-m-d', $request->fecha)->startOfDay();/* startofDay reseteo las horas 000000 y dejo solo la fecha */
                            $query->whereDate('created_at', $fecha);
                        })
                        ->orderBy('hora_llegada', 'desc')
                        ->get();

                        //aqui contamos los dias trabajados por empleado
                       /*  $diasTrabajados = [];
                        foreach ($asistencias as $asistencia) {
                            $empleadoId = $asistencia->empleado_id;

                            if (!isset($diasTrabajados[$empleadoId])) {// realiza la consulta si es que todavia no calculo
                                $diasTrabajados[$empleadoId] = Asistencia::where('empleado_id', $empleadoId)->count();
                            }
                        } */
                    
        return view('asistencias.index', compact('asistencias'/* , 'diasTrabajados' */));
    }
    
}
