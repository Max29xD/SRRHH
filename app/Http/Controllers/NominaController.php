<?php

namespace App\Http\Controllers;

use App\Models\Descuento;
use Illuminate\Http\Request;
use App\Models\Nomina;
use App\Models\Empleado;
use Carbon\Carbon;

class NominaController extends Controller
{
   
    public function calcular(Request $request)
    {
        return $ultimoRegistro = Nomina::latest()->first();

        $empleados = Empleado::withCount('asistencias')
            ->having('asistencias_count', '<=', 30)
            ->get();

        // Obtenemos los empleados que tienen 30 días trabajados
       /*  $empleados = Empleado::whereHas('nominas', function ($query) {
            $query->where('estado', false);
        })
        ->withCount('asistencias')
        ->having('asistencias_count', '<=', 30)
        ->get(); */

        // Calculamos y asignamos los atributos adicionales a cada empleado
        foreach ($empleados as $empleado) {
            // Obtenemos los datos laborales del empleado
            $datosLaborales = $empleado->datosLaborales;

            // Validamos que existan datos laborales para el empleado
            if ($datosLaborales) {
                // guardando el sueldo
                $sueldo = $datosLaborales->salario;

                // ganado por dia
                $pagoPorDia = $sueldo / 30;

                // Calculo de los años de antigüedad
                $antiguedad = Carbon::parse($datosLaborales->fechaContratacion)->diffInYears(Carbon::now());

                // Haciendo el cálculo del bono de antigüedad
                $bonoAntiguedad = ($antiguedad >= 1) ? $sueldo * 0.05 * $antiguedad : 0;

                // no lo toma en cuenta si no tienes días trabajados
                if ($empleado->asistencias_count > 0) {
                    $totalGanado = ($pagoPorDia * $empleado->asistencias_count) + $bonoAntiguedad;

                    // Obtener el total de descuentos aplicados a la nómina del empleado
                    $totalDescuentos = $totalGanado * 0.1271 + $totalGanado * 0.13;
                    

                    $liquidoPagable = $totalGanado - $totalDescuentos;
                } else {
                    $totalGanado = 0;
                    $totalDescuentos = 0;
                    $bonoAntiguedad = 0;
                    $descuentoAFP = 0;
                    $descuentoRCIVA = 0;
                    $liquidoPagable = 0;
                }

                // Asignar estos valores al objeto Empleado
                $empleado->diasTrabajados = $empleado->asistencias_count;
                $empleado->bonoAntiguedad = $bonoAntiguedad;
                $empleado->sueldo = $sueldo;
                $empleado->totalGanado = $totalGanado;
                $empleado->afp = $totalGanado * 0.1271;
                $empleado->rc_iva = $totalGanado * 0.13;
                $empleado->totalDescuento = $totalDescuentos;
                $empleado->liquidoPagable = $liquidoPagable;
            }
           /*  return $empleados->nomina->estado; */
        }
       

        // Almacenar los datos en la sesión
    session()->put('empleados_calculados', $empleados);//solo agregue esta linea

     return view('nomina.index', compact('empleados'));
}


public function aplicarDescuentos(Request $request)
{
    // Recuperar los datos calculados de la sesión
    $empleados = session()->get('empleados_calculados', []);

    // Validar los datos del formulario
    $validated = $request->validate([
        'empleado_id' => 'required|exists:empleados,id',
        'monto' => 'required|numeric|min:0',
        'tipoDescuento' => 'required|string',
        'descripcion' => 'nullable|string',
    ]);
    

    // Encontrar el empleado en los datos almacenados en la sesión
    $empleado = $empleados->firstWhere('id', $validated['empleado_id']);
    

    if ($empleado) {
        // Aplicar el descuento temporalmente
        $empleado->totalDescuento = $empleado->totalDescuento + $validated['monto'];
        $empleado->liquidoPagable = $empleado->liquidoPagable - $validated['monto'];

        /* Descuento::create([ se debe de guardar solo si la nomina se graba
            'empleado_id' => $validated['empleado_id'],
            'monto' => $validated['monto'],
            'tipoDescuento' => $validated['tipoDescuento'],
            'descripcion' => $validated['descripcion'],
        ]); */
        
        // Pasar los datos modificados a la vista
        return view('nomina.index', compact('empleados'));
    } else {
        return redirect()->back()->withErrors(['empleado_id' => 'Empleado no encontrado.']);
    }
    
}
public function guardar(Request $request)
{
     // Obtener la lista de empleados desde la sesión
     $empleados = session()->get('empleados_calculados', []);

     // Iterar sobre cada empleado para guardar la nómina
     foreach ($empleados as $empleado) {
         // Crear un nuevo registro en la tabla `nominas`
        Nomina::create([
             'empleado_id' => $empleado->id,
             'fecha' => now(),
             'diasTrabajados' => $empleado->diasTrabajados,
             'bonoAntiguedad' => $empleado->bonoAntiguedad,
             'totalGanado' => $empleado->totalGanado,
             'afp' => $empleado->afp,
             'rc_iva' => $empleado->rc_iva,
             'totalDescuento' => $empleado->totalDescuento,
             'liquidoPagable' => $empleado->liquidoPagable,
             'estado' => true, // Cambia a false si deseas marcar como no pagado
         ]);
     }
    return redirect()->route('nomina.calcular')->with('success', 'Nómina guardada exitosamente');
}
//-----------------------agregado---------------------------



public function boleta($nomina_id)
    {
        return  $nomina = Nomina::with('empleado')->findOrFail($nomina_id);
       /*  return view('nomina.boleta', compact('nomina')); */
    }
}   