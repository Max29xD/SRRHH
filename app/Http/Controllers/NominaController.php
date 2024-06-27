<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nomina;
use App\Models\Empleado;
use Carbon\Carbon;

class NominaController extends Controller
{
   
    public function calcular()
    {
        // Obtenemos los empleados que tienen menos de 30 días trabajados
        $empleados = Empleado::withCount('asistencias')
            ->having('asistencias_count', '<', 30)
            ->get();

        // Calculamos y asignamos los atributos adicionales a cada empleado
        foreach ($empleados as $empleado) {
            
            // Obtenemos los datos laborales del empleado
            $datosLaborales = $empleado->datosLaborales;

            // Validamos que existan datos laborales para el empleado
            if ($datosLaborales) {
                // guardando el sueldo
                $sueldo = $datosLaborales->salario;

                // Calculo de los años de antigüedad
                $antiguedad = Carbon::parse($datosLaborales->fechaContratacion)->diffInYears(Carbon::now());

                // Haciendo el cálculo del bono de antigüedad
                if($antiguedad >= 1){
                    $bonoAntiguedad = $sueldo * 0.05 * $antiguedad;
                } else {
                    $bonoAntiguedad = 0;
                }

                // Calculo del descuento AFP
                $descuentoAFP = $sueldo * 0.1271;

                // Calcular total ganado
                $totalGanado = $sueldo + $bonoAntiguedad; 

                // Calcular líquido pagable
                $liquidoPagable = $totalGanado - $descuentoAFP;

                // Asignar estos valores al objeto Empleado
                $empleado->diasTrabajados = $empleado->asistencias_count;
                $empleado->bonoAntiguedad = $bonoAntiguedad;
                $empleado->sueldo = $sueldo;
                $empleado->totalGanado = $totalGanado;
                $empleado->afp = $descuentoAFP;
                $empleado->descuento = $descuentoAFP;

                $empleado->liquidoPagable = $liquidoPagable;
            }
        }

        return view('nomina.index', compact('empleados'));
    }

    public function generarBoleta(Request $request, $empleado_id)
    {
        $empleado = Empleado::withCount('asistencias')->findOrFail($empleado_id);
        $datosLaborales = $empleado->datosLaborales;

        if ($datosLaborales) {
            // guarda el sueldo
            $sueldo = $datosLaborales->salario;

            // Calculo de los años de antigüedad
            $antiguedad = Carbon::parse($datosLaborales->fechaContratacion)->diffInYears(Carbon::now());

            //lo toma en cuenta si tiene mas de un año de antiguedad si no va a ser 0 por defecto
            if($antiguedad >= 1){
                $bonoAntiguedad = $sueldo * 0.05 * $antiguedad;
            } else {
                $bonoAntiguedad = 0;
            }


            // descuento AFP de la afp
            $descuentoAFP = $sueldo * 0.1271;

            // Calcular total ganado
            $totalGanado = $sueldo + $bonoAntiguedad;

            // Obtener el descuento del formulario, asegurando que no sea nulo
            $descuento = $request->input('descuento', 0);

            //líquido pagable
            $liquidoPagable = $totalGanado - $descuento - $descuentoAFP;

            // Guardar en la tabla de nóminas
            $nomina = Nomina::create([
                'empleado_id' => $empleado->id,
                'diasTrabajados' => $empleado->asistencias_count,
                'bonoAntiguedad' => $bonoAntiguedad,
                'totalGanado' => $totalGanado,
                'afp' => $descuentoAFP,
                'descuento' => $descuento,
                'liquidoPagable' => $liquidoPagable,
            ]);

            return redirect()->route('nomina.boleta', ['nomina' => $nomina->id])
                ->with('success', 'Boleta de pago generada correctamente');
        }

        return redirect()->back()->with('error', 'No se pudo generar la boleta de pago');
    }

    public function boleta($nomina_id)
    {
        $nomina = Nomina::with('empleado')->findOrFail($nomina_id);
        return view('nomina.boleta', compact('nomina'));
    }
}